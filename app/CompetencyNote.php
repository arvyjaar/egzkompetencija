<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompetencyNote extends Model
{
    use SoftDeletes;

    public $table = 'competencynotes';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'monitoringreport_id',
        'competency_id',
        'text',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
