<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluation extends Model
{
    use SoftDeletes;

    public $table = 'evaluations';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'competency_id',
        'criterion_id',
        'point_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $with = ['criterion', 'point'];

    public function criterion()
    {
        return $this->belongsTo('App\Criterion', 'criterion_id');
    }

    public function competency()
    {
        return $this->belongsTo('App\Competency', 'competency_id');
    }

    public function point()
    {
        return $this->belongsTo('App\Point', 'point_id');
    }
}
