<?php
namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\User;
use App\Support\ImageData;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PortfolioController extends Controller
{
    public const TEMPLATES = [
        'simple'   => ['Simple',   'Clean and professional. One calm column that is easy to read.'],
        'modern'   => ['Modern',   'Cards, sections and colour with a bold header and grid layout.'],
        'creative' => ['Creative', 'Dark, playful and asymmetric, with moving shapes and big type.'],
    ];

    private const WITH = ['educations', 'skills', 'projects', 'experiences', 'socialLinks'];

    private function mine(Request $r): ?Portfolio
    {
        return $r->user()->portfolio?->load(self::WITH);
    }

    /** Manage Portfolio page: view, edit, delete. */
    public function dashboard(Request $r)
    {
        return view('dashboard', ['p' => $this->mine($r), 'templates' => self::TEMPLATES]);
    }

    /** Portfolio Information page (used for both create and edit). */
    public function form(Request $r)
    {
        $p = $this->mine($r) ?? new Portfolio(['full_name' => '', 'email' => $r->user()->email]);
        return view('portfolio-form', compact('p'));
    }

    public function save(Request $r)
    {
        $d = $r->validate([
            'full_name' => 'required|string|max:100', 'headline' => 'nullable|string|max:140',
            'email' => 'required|email|max:120', 'phone' => 'nullable|string|max:30', 'address' => 'nullable|string|max:200',
            'about' => 'nullable|string|max:3000',
            'photo' => 'nullable|image|max:4096', 'remove_photo' => 'nullable|boolean',
            'skills' => 'nullable|string|max:900',
            'educations' => 'nullable|array|max:10',
            'educations.*.school' => 'nullable|string|max:120', 'educations.*.degree' => 'nullable|string|max:120', 'educations.*.years' => 'nullable|string|max:40',
            'experiences' => 'nullable|array|max:10',
            'experiences.*.company' => 'nullable|string|max:120', 'experiences.*.role' => 'nullable|string|max:120',
            'experiences.*.years' => 'nullable|string|max:40', 'experiences.*.description' => 'nullable|string|max:600',
            'projects' => 'nullable|array|max:10',
            'projects.*.title' => 'nullable|string|max:100', 'projects.*.description' => 'nullable|string|max:600',
            'projects.*.photo' => 'nullable|image|max:4096',
            'links' => 'nullable|array|max:10',
            'links.*.label' => 'nullable|string|max:40', 'links.*.url' => 'nullable|url:http,https|max:255',
        ], [
            'photo.image' => 'The profile picture must be a JPG, PNG, WebP or GIF image.',
            'projects.*.photo.image' => 'Project pictures must be JPG, PNG, WebP or GIF images.',
            'links.*.url.url' => 'Links must start with http:// or https://',
        ]);

        DB::transaction(function () use ($r, $d) {
            $user = $r->user();
            $p = $user->portfolio ?: new Portfolio(['user_id' => $user->id]);
            $p->fill(Arr::only($d, ['full_name', 'headline', 'email', 'phone', 'address', 'about']));
            if ($r->boolean('remove_photo')) $p->photo = null;
            if ($f = $r->file('photo')) $p->photo = ImageData::fromUpload($f, 600) ?? $p->photo;
            $p->save();

            // Replace the simple child rows.
            $p->educations()->delete();
            $p->educations()->createMany($this->rows($r, 'educations', ['school', 'degree', 'years']));
            $p->experiences()->delete();
            $p->experiences()->createMany($this->rows($r, 'experiences', ['company', 'role', 'years', 'description']));
            $p->socialLinks()->delete();
            $p->socialLinks()->createMany($this->rows($r, 'links', ['label', 'url']));

            $p->skills()->delete();
            $p->skills()->createMany(
                collect(explode(',', (string) ($d['skills'] ?? '')))
                    ->map(fn ($s) => mb_substr(trim($s), 0, 60))->filter()->unique()->take(30)
                    ->map(fn ($s) => ['name' => $s])->values()->all()
            );

            // Projects keep their existing picture unless a new one is uploaded.
            $existing = $p->projects()->get()->keyBy('id');
            $keep = [];
            foreach ($r->input('projects', []) as $i => $row) {
                if (!is_array($row) || !is_string($row['title'] ?? null) || trim($row['title']) === '') continue;
                $old = $existing->get((int) ($row['id'] ?? 0));
                $image = $old?->image;
                if ($f = $r->file("projects.$i.photo")) $image = ImageData::fromUpload($f, 900) ?? $image;
                $attrs = ['title' => trim($row['title']), 'description' => (is_string($row['description'] ?? null) ? trim($row['description']) : '') ?: null, 'image' => $image];
                if ($old) { $old->update($attrs); $keep[] = $old->id; }
                else { $keep[] = $p->projects()->create($attrs)->id; }
                if (count($keep) >= 10) break;
            }
            $p->projects()->whereNotIn('id', $keep)->delete();
        });

        return redirect()->route('portfolio.template')->with('status', 'Saved to the online database. Now choose a template.');
    }

    /** Template Selection page. */
    public function templates(Request $r)
    {
        $p = $this->mine($r);
        if (!$p) return redirect()->route('portfolio.create')->with('status', 'Enter your information first.');
        return view('choose', ['p' => $p, 'templates' => self::TEMPLATES]);
    }

    public function choose(Request $r)
    {
        $d = $r->validate(['template' => 'required|in:simple,modern,creative']);
        $p = $r->user()->portfolio;
        if (!$p) return redirect()->route('portfolio.create');
        $p->update($d);
        return redirect()->route('portfolio.preview')
            ->with('status', 'Portfolio generated with the ' . self::TEMPLATES[$d['template']][0] . ' template.');
    }

    /** Portfolio Preview page. ?t=template previews another template without saving it. */
    public function preview(Request $r)
    {
        $p = $this->mine($r);
        if (!$p) return redirect()->route('portfolio.create')->with('status', 'Enter your information first.');
        $t = $r->query('t');
        $t = (is_string($t) && isset(self::TEMPLATES[$t])) ? $t : $p->template;
        return view('portfolio', ['p' => $p, 't' => $t, 'saved' => $p->template, 'preview' => !$r->boolean('embed')]);
    }

    public function destroy(Request $r)
    {
        $r->user()->portfolio?->delete(); // child rows go with it (ON DELETE CASCADE)
        return redirect()->route('dashboard')->with('status', 'Your portfolio was deleted from the database.');
    }

    /** Public page: /u/username */
    public function show(string $username)
    {
        $p = User::where('username', strtolower($username))->first()?->portfolio;
        abort_unless($p, 404);
        $p->load(self::WITH);
        return view('portfolio', ['p' => $p, 't' => $p->template, 'saved' => $p->template, 'preview' => false]);
    }

    private function rows(Request $r, string $key, array $fields): array
    {
        return collect($r->input($key, []))
            ->filter(fn ($row) => is_array($row) && is_string($row[$fields[0]] ?? null) && trim($row[$fields[0]]) !== '')
            ->take(10)
            ->map(fn ($row) => Arr::only(array_map(fn ($v) => is_string($v) ? trim($v) : null, $row), $fields) + array_fill_keys($fields, null))
            ->values()->all();
    }
}
