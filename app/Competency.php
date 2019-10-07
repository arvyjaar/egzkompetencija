<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competency extends Model
{
    use SoftDeletes;

    public $table = 'competencies';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function criterion()
    {
        return $this->hasMany('App\Criterion', 'competency_id');
    }
}
