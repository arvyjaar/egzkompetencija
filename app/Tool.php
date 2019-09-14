<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tool extends Model
{
    use SoftDeletes;

    public $table = 'tools';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'note',
        'title',
        'model',
        'branch_id',
        'condition',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
