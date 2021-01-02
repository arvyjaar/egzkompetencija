<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssessmentType extends Model
{
    use SoftDeletes;

    public $table = 'assessment_types';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'assessment_values',
        'description',
        'bad_values',
    ];

    public function getBadValuesAttribute($value)
    {
        return json_decode($value);
    }
}
