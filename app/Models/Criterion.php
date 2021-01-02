<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Criterion extends Model
{
    use SoftDeletes;

    public $table = 'criteria';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'competency_id',
        'assessment_type_id',
    ];

    protected $with = ['competency', 'assessment'];

    public function competency() {
        return $this->belongsTo('App\Models\Competency');
    }

    public function assessment() {
        return $this->belongsTo('App\Models\AssessmentType', 'assessment_type_id');
    }
}
