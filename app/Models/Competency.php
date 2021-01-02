<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Competency extends Model
{
    use SoftDeletes;

    public $table = 'competencies';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'worktype_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $with = ['worktype'];

    // example: return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id');
    public function form() {
        return $this->belongsToMany('App\Models\Form', 'form_competency');
    }

    public function worktype()
    {
        return $this->belongsTo('App\Models\Worktype', 'worktype_id');
    }

        public function criterion()
    {
        return $this->hasMany('App\Models\Criterion', 'competency_id');
    }
}
