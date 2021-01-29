<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'forms';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'worktype_id',
        'title',
        'version',
        'active'
    ];

    public function competency()
    {
        return $this->belongsToMany('App\Models\Competency', 'form_competency');
    }

    public function worktype()
    {
        return $this->belongsTo('App\Models\Worktype');
    }

    public function getHasReportsAttribute()
    {
        return (Report::where('form_id', $this->id)->count() > 0) ? true : false;
    }

    public function report() 
    {
        return $this->hasMany('App\Models\Report');
    }
}
