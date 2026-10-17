<?php
namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Validation\ValidationException;

/** Turns an uploaded picture into a data URI so it can live in the online database. */
class ImageData
{
    private const FALLBACK_MAX_BYTES = 1_500_000;

    public static function fromUpload(UploadedFile $file, int $max = 800): ?string
    {
        $path = $file->getRealPath();
        return $path ? self::fromPath($path, $max) : null;
    }

    public static function fromPath(string $path, int $max = 800): ?string
    {
        $info = @getimagesize($path);
        if (!$info || ($info[0] * $info[1]) > 40_000_000) return null;

        // No GD on this server: store the original file as it is (small pictures only).
        if (!function_exists('imagecreatetruecolor') || !function_exists('imagejpeg')) {
            return self::raw($path, $info);
        }

        $src = match ($info[2]) {
            IMAGETYPE_JPEG => function_exists('imagecreatefromjpeg') ? @imagecreatefromjpeg($path) : false,
            IMAGETYPE_PNG  => function_exists('imagecreatefrompng') ? @imagecreatefrompng($path) : false,
            IMAGETYPE_GIF  => function_exists('imagecreatefromgif') ? @imagecreatefromgif($path) : false,
            IMAGETYPE_WEBP => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($path) : false,
            default        => false,
        };
        if (!$src) return self::raw($path, $info);

        if ($info[2] === IMAGETYPE_JPEG && function_exists('exif_read_data')) {
            $exif = @exif_read_data($path);
            $angle = match ($exif['Orientation'] ?? 1) { 3 => 180, 6 => -90, 8 => 90, default => 0 };
            if ($angle && ($rot = imagerotate($src, $angle, 0))) $src = $rot;
        }

        $w = imagesx($src); $h = imagesy($src);
        $scale = min(1, $max / max($w, $h));
        $nw = max(1, (int) round($w * $scale)); $nh = max(1, (int) round($h * $scale));

        $dst = imagecreatetruecolor($nw, $nh);
        imagefill($dst, 0, 0, imagecolorallocate($dst, 255, 255, 255)); // flatten transparency onto white
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $nw, $nh, $w, $h);

        ob_start();
        imagejpeg($dst, null, 78);
        $bin = ob_get_clean();

        return $bin ? 'data:image/jpeg;base64,' . base64_encode($bin) : null;
    }

    private static function raw(string $path, array $info): ?string
    {
        $mime = image_type_to_mime_type($info[2]);
        if (!in_array($mime, ['image/jpeg', 'image/png', 'image/gif', 'image/webp'], true)) return null;
        if (filesize($path) > self::FALLBACK_MAX_BYTES) {
            throw ValidationException::withMessages(['photo' => 'That picture is too large for this server. Please use one under 1.5 MB.']);
        }
        return 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($path));
    }
}
