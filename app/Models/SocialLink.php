<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $table = 'social_links';
    protected $guarded = [];
    public $timestamps = false;

    public function portfolio() { return $this->belongsTo(Portfolio::class); }
}
