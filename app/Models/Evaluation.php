<?php

namespace App\Models;

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
        'report_id',
        'competency_id',
        'criterion_id',
        'assessment_type_id',
        'assessment_value',
    ];

    protected $with = ['criterion'];

    public function criterion()
    {
        return $this->belongsTo('App\Models\Criterion', 'criterion_id');
    }

    public function report()
    {
        return $this->belongsTo('App\Models\Report', 'report_id');
    }

    public function assessment()
    {
        return $this->belongsTo('App\Models\AssessmentType', 'assessment_type_id');
    }
}
