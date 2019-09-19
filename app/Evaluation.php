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
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function monitoringreports()
    {
        return $this->belongsTo(MonitoringReport::class);
    }

    public function criterias()
    {
        return $this->belongsTo(Criterion::class);
    }
}
