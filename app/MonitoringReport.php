<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonitoringReport extends Model
{
    use SoftDeletes;

    public $table = 'monitoring_reports';

    const OBSERVING_TYPE_RADIO = [
        'EGZ' => 'Egzaminas',
        'VID' => 'Vaizdo įrašas',
    ];

    const CATEGORIES = ['', 'B', 'A1', 'A2', 'A', 'C', 'CE', 'D', 'BE', 'B96', 'C1', 'D1', 'B1'];

    protected $dates = [
        'exam_date',
        'created_at',
        'updated_at',
        'deleted_at',
        'observing_date',
        'examiner_reviewed',
    ];

    protected $fillable = [
        'branch_id',
        'examiner_id',
        'observer_id',
        'drivecategory',
        'exam_date',
        'observing_date',
        'observing_type',
        'observer_note',
        'examiner_note',
        'technical_note',
        'evpis_note',
        'examiner_reviewed',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //protected $with = ['examiner', 'observer', 'branch'];

    public function examiner()
    {
        return $this->belongsTo('App\User', 'examiner_id');
    }

    public function observer()
    {
        return $this->belongsTo('App\User', 'observer_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch', 'branch_id');
    }

    public function competency()
    {
        return $this->hasMany('App\Competency', 'monitoringreport_id');
    }

    public function getExamDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setExamDateAttribute($value)
    {
        $this->attributes['exam_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getObservingDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setObservingDateAttribute($value)
    {
        $this->attributes['observing_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getExaminerReviewedAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setExaminerReviewedAttribute($value)
    {
        $this->attributes['examiner_reviewed'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}
