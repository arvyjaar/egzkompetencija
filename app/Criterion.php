<?php

namespace App;

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
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $with = ['competency'];

    public function competency() {
        return $this->belongsTo('App\Competency', 'competency_id');
    }
}
