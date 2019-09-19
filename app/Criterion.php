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
        'critcategory_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function critcategory() {
        return $this->belongsTo('App\Critcategory', 'critcategory_id');
    }
}
