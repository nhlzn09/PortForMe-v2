<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $table = 'experiences';
    protected $guarded = [];
    public $timestamps = false;

    public function portfolio() { return $this->belongsTo(Portfolio::class); }
}
