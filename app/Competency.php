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
        'monitoringreport_id',
        'category_id',
        'note',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function evaluation()
    {
        return $this->hasMany('App\Evaluation', 'competency_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }
}
