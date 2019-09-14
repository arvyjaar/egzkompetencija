@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.monitoringReport.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.monitoring-reports.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('observer') ? 'has-error' : '' }}">
                <label for="observer">{{ trans('cruds.monitoringReport.fields.observer') }}*</label>
                <input type="text" id="observer" name="observer" class="form-control" value="{{ old('observer', isset($monitoringReport) ? $monitoringReport->observer : '0') }}" required>
                @if($errors->has('observer'))
                    <p class="help-block">
                        {{ $errors->first('observer') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.monitoringReport.fields.observer_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
                <label for="user">{{ trans('cruds.monitoringReport.fields.user') }}*</label>
                <select name="user_id" id="user" class="form-control select2" required>
                    @foreach($users as $id => $user)
                        <option value="{{ $id }}" {{ (isset($monitoringReport) && $monitoringReport->user ? $monitoringReport->user->id : old('user_id')) == $id ? 'selected' : '' }}>{{ $user }}</option>
                    @endforeach
                </select>
                @if($errors->has('user_id'))
                    <p class="help-block">
                        {{ $errors->first('user_id') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('branch') ? 'has-error' : '' }}">
                <label for="branch">{{ trans('cruds.monitoringReport.fields.branch') }}*</label>
                <input type="text" id="branch" name="branch" class="form-control" value="{{ old('branch', isset($monitoringReport) ? $monitoringReport->branch : '0') }}" required>
                @if($errors->has('branch'))
                    <p class="help-block">
                        {{ $errors->first('branch') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.monitoringReport.fields.branch_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('exam_date') ? 'has-error' : '' }}">
                <label for="exam_date">{{ trans('cruds.monitoringReport.fields.exam_date') }}*</label>
                <input type="text" id="exam_date" name="exam_date" class="form-control datetime" value="{{ old('exam_date', isset($monitoringReport) ? $monitoringReport->exam_date : '') }}" required>
                @if($errors->has('exam_date'))
                    <p class="help-block">
                        {{ $errors->first('exam_date') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.monitoringReport.fields.exam_date_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                <label for="category">{{ trans('cruds.monitoringReport.fields.category') }}*</label>
                <input type="text" id="category" name="category" class="form-control" value="{{ old('category', isset($monitoringReport) ? $monitoringReport->category : '0') }}" required>
                @if($errors->has('category'))
                    <p class="help-block">
                        {{ $errors->first('category') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.monitoringReport.fields.category_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('observing_date') ? 'has-error' : '' }}">
                <label for="observing_date">{{ trans('cruds.monitoringReport.fields.observing_date') }}*</label>
                <input type="text" id="observing_date" name="observing_date" class="form-control date" value="{{ old('observing_date', isset($monitoringReport) ? $monitoringReport->observing_date : '') }}" required>
                @if($errors->has('observing_date'))
                    <p class="help-block">
                        {{ $errors->first('observing_date') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.monitoringReport.fields.observing_date_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('observing_type') ? 'has-error' : '' }}">
                <label>{{ trans('cruds.monitoringReport.fields.observing_type') }}*</label>
                @foreach(App\MonitoringReport::OBSERVING_TYPE_RADIO as $key => $label)
                    <div>
                        <input id="observing_type_{{ $key }}" name="observing_type" type="radio" value="{{ $key }}" {{ old('observing_type', 1) === (string)$key ? 'checked' : '' }} required>
                        <label for="observing_type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('observing_type'))
                    <p class="help-block">
                        {{ $errors->first('observing_type') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('technical_notes') ? 'has-error' : '' }}">
                <label for="technical_notes">{{ trans('cruds.monitoringReport.fields.technical_notes') }}</label>
                <textarea id="technical_notes" name="technical_notes" class="form-control ">{{ old('technical_notes', isset($monitoringReport) ? $monitoringReport->technical_notes : '') }}</textarea>
                @if($errors->has('technical_notes'))
                    <p class="help-block">
                        {{ $errors->first('technical_notes') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.monitoringReport.fields.technical_notes_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('observer_notes') ? 'has-error' : '' }}">
                <label for="observer_notes">{{ trans('cruds.monitoringReport.fields.observer_notes') }}</label>
                <textarea id="observer_notes" name="observer_notes" class="form-control ckeditor">{{ old('observer_notes', isset($monitoringReport) ? $monitoringReport->observer_notes : '') }}</textarea>
                @if($errors->has('observer_notes'))
                    <p class="help-block">
                        {{ $errors->first('observer_notes') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.monitoringReport.fields.observer_notes_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('examiner_notes') ? 'has-error' : '' }}">
                <label for="examiner_notes">{{ trans('cruds.monitoringReport.fields.examiner_notes') }}</label>
                <textarea id="examiner_notes" name="examiner_notes" class="form-control ckeditor">{{ old('examiner_notes', isset($monitoringReport) ? $monitoringReport->examiner_notes : '') }}</textarea>
                @if($errors->has('examiner_notes'))
                    <p class="help-block">
                        {{ $errors->first('examiner_notes') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.monitoringReport.fields.examiner_notes_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('examiner_reviewed') ? 'has-error' : '' }}">
                <label for="examiner_reviewed">{{ trans('cruds.monitoringReport.fields.examiner_reviewed') }}</label>
                <input type="text" id="examiner_reviewed" name="examiner_reviewed" class="form-control datetime" value="{{ old('examiner_reviewed', isset($monitoringReport) ? $monitoringReport->examiner_reviewed : '') }}">
                @if($errors->has('examiner_reviewed'))
                    <p class="help-block">
                        {{ $errors->first('examiner_reviewed') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.monitoringReport.fields.examiner_reviewed_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('evpis_notes') ? 'has-error' : '' }}">
                <label for="evpis_notes">{{ trans('cruds.monitoringReport.fields.evpis_notes') }}</label>
                <textarea id="evpis_notes" name="evpis_notes" class="form-control ckeditor">{{ old('evpis_notes', isset($monitoringReport) ? $monitoringReport->evpis_notes : '') }}</textarea>
                @if($errors->has('evpis_notes'))
                    <p class="help-block">
                        {{ $errors->first('evpis_notes') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.monitoringReport.fields.evpis_notes_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection