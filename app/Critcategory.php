<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Critcategory extends Model
{
    use SoftDeletes;

    public $table = 'critcategories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // Relation should always be loaded (eager loading)
    protected $with = ['criteria'];

    public function criteria()
    {
        return $this->hasMany('App\Criterion');
    }
}
