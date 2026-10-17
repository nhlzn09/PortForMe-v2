<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';
    protected $guarded = [];
    public $timestamps = false;

    public function portfolio() { return $this->belongsTo(Portfolio::class); }
}
