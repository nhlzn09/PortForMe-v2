<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skills';
    protected $guarded = [];
    public $timestamps = false;

    public function portfolio() { return $this->belongsTo(Portfolio::class); }
}
