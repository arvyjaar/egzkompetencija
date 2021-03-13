<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompetencyNote extends Model
{
    use SoftDeletes;

    public $table = 'competency_notes';

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
