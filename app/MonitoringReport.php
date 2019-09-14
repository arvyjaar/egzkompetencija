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

    protected $dates = [
        'exam_date',
        'created_at',
        'updated_at',
        'deleted_at',
        'observing_date',
        'examiner_reviewed',
    ];

    protected $fillable = [
        'branch',
        'user_id',
        'observer_id',
        'category',
        'exam_date',
        'observing_date',
        'observing_type',
        'observer_notes',
        'examiner_notes',
        'technical_notes',
        'evpis_notes',
        'examiner_reviewed',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
