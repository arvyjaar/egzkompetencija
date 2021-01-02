<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;

    public $table = 'reports';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'form_id',
        'employee_id',
        'observer_id',
        'drivecategory_id',
        'procedure_date',
        'observing_date',
        'observing_type_id',
        'observer_note',
        'employee_note',
        'technical_note',
        'manager_note',
        'employee_reviewed_at',
    ];

    public function employee()
    {
        return $this->belongsTo('App\Models\User', 'employee_id');
    }

    public function observer()
    {
        return $this->belongsTo('App\Models\User', 'observer_id');
    }

    public function evaluation()
    {
        return $this->hasMany('App\Models\Evaluation', 'report_id');
    }

    public function competencyNote()
    {
        return $this->hasMany('App\Models\CompetencyNote', 'report_id');
    }

    public function observingType()
    {
        return $this->belongsTo('App\Models\ObservingType');
    }

    public function form()
    {
        return $this->belongsTo('App\Models\Form');
    }

    public function drivecategory()
    {
        return $this->belongsTo('App\Models\Drivecategory');
    }

    public function getProcedureDateAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setProcedureDateAttribute($value)
    {
        $this->attributes['procedure_date'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getObservingDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setObservingDateAttribute($value)
    {
        $this->attributes['observing_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getEmployeeReviewedAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmployeeReviewedAttribute($value)
    {
        $this->attributes['employee_reviewed_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function evaluationSet()
    {
        $evaluation_set = $this->evaluation->groupBy('criterion.competency.title');
        foreach ($evaluation_set as $id => $competency) {
            $competency->competency_id = ($competency->first()->criterion->competency_id ?? 0);
            $notes = $this->competencyNote()->where('competency_id', $competency->competency_id);
            $competency->competency_note = (
                $notes->count() > 0 ?
                $this->competencyNote->where('competency_id', $competency->competency_id)->first()->text
                :
                null
            );
        }
        return $evaluation_set;
    }

    // ToDo: somewhere must be restriction that prevents creating report with empty competencies (without criteria)
}
