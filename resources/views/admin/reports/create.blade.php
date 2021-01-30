@extends('layouts.admin') @section('content')

<div class="card">
    <div class="card-header alert alert-info">
        {{ trans('global.new'). ' '.trans('cruds.report.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route('admin.reports.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-4">
                    <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
                        <label for="employee_id">{{ trans('cruds.report.fields.employee') }}*</label>
                        <select name="employee_id" id="employee_id" class="form-control select2"
                            data-live-search="true">
                            @foreach($users as $id => $user)
                            <option value="{{ $id }}" {{ old('employee_id') == $id ? 'selected' : '' }}>
                                {{ $user }}
                            </option>
                            @endforeach
                        </select>
                        @if($errors->has('employee_id'))
                        <p class="help-block">
                            {{ $errors->first('employee_id') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-4">
                    <label for="observer_id">{{ trans('cruds.report.fields.observer') }}*</label>
                    <input type="text" class="form-control" disabled="disabled"
                        placeholder="{{ auth()->user()->name }}" />
                </div>
                <div class="col-4">
                    <label for="form_id">{{ trans('cruds.form.title_singular') }}*</label>
                    <select name="form_id" id="form_id" class="form-control">
                        <option value="{{ $form->id }}" selected>
                            {{ $form->title }}, v.{{ $form->version }}
                        </option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group {{ $errors->has('drivecategory_id') ? 'has-error' : '' }}">
                        <label for="drivecategory_id">{{ trans('cruds.report.fields.category') }}</label>
                        <select type="text" id="drivecategory_id" name="drivecategory_id" class="form-control">
                            @foreach($drivecategories as $id => $title)
                            <option value="{{ $id }}" {{ old('drivecategory_id') == $id ? 'selected' : '' }}>
                                {{ $title }}
                            </option>
                            @endforeach
                        </select>
                        @if($errors->has('drivecategory_id'))
                        <p class="help-block">
                            {{ $errors->first('drivecategory_id') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group {{ $errors->has('procedure_date') ? 'has-error' : '' }}">
                        <label for="procedure_date">
                            {{ trans('cruds.report.fields.procedure_datetime') }}*</label>
                        <input type="text" id="procedure_date" name="procedure_date" class="form-control datetime"
                            value="{{ old('procedure_date') }}" required />
                        @if($errors->has('procedure_date'))
                        <p class="help-block">
                            {{ $errors->first('procedure_date') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group {{ $errors->has('observing_date') ? 'has-error' : '' }}">
                        <label for="observing_date">{{ trans('cruds.report.fields.observing_date') }}*</label>
                        <input type="text" id="observing_date" name="observing_date" class="form-control date"
                            value="{{ old('observing_date') }}" required>
                        @if($errors->has('observing_date'))
                        <p class="help-block">
                            {{ $errors->first('observing_date') }}
                        </p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group {{ $errors->has('observing_type_id') ? 'has-error' : '' }}">
                        <b>{{ trans('cruds.report.fields.observing_type') }}*: &nbsp;</b>
                        @foreach($observing_types as $id => $title)
                        <div class="icheck-primary icheck-inline">
                            <input type="radio" id="observing_type_{{ $id }}" name="observing_type_id" value="{{ $id }}"
                                {{ (old('observing_type_id') == $id) ? 'checked' : ''}} required />
                            <label class="custom-label" for="observing_type_{{ $id }}"> {{ $title }}</label>                           
                        </div>
                        @endforeach 
                        @if($errors->has('observing_type_id'))
                        <p class="help-block">
                            {{ $errors->first('observing_type_id') }}
                        </p>
                        @endif
                    </div>
                </div>
            </div>
            {{-- there goes competencies and competency notes --}}
            @foreach($competencies as $competency)
            <div class="row">
                <div class="col-12">
                    <strong>{{ $competency->title }}</strong>
                </div>
            </div>
            {{-- there goes evaluations --}}
            @foreach($competency->criterion as $criterion)
            <div class="row">
                <div class="col-6">
                    <p class="criterion">{{ $criterion->title }}</p>
                </div>
                <div class="col-6">
                    {{-- there goes points for each evaluation --}}
                    @foreach(json_decode($criterion->assessment->assessment_values) as $point)
                    <div class="icheck-primary icheck-inline">
                        <input type="radio" class="point" id="point_cr{{ $criterion->id }}_p{{ $point->value }}"
                            name="point[{{ $criterion->id }}]" value="{{ $point->value }}"
                            {{ (null !== old('point.'.$criterion->id) && old('point.'.$criterion->id) == $point->value) ? 'checked' : ''}}
                            required />
                        <label class="custom-label" for="point_cr{{ $criterion->id }}_p{{ $point->value }}">
                            {{ $point->title }}
                        </label>    
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
            <div class="form-group {{ $errors->has('competency_note') ? 'has-error' : '' }}">
                <label for="competency_note">{{ trans('cruds.report.fields.notes') }}</label>
                <textarea id="competency_note_{{ $competency->id }}" name="competency_note[{{ $competency->id }}]"
                    class="form-control">{{ old('competency_note.'.$competency->id) }}</textarea>
                @if($errors->has('competency_note'))
                <p class="help-block">
                    {{ $errors->first('competency_note.*') }}
                </p>
                @endif
            </div>
            @endforeach

            <div class="form-group {{ $errors->has('technical_note') ? 'has-error' : '' }}">
                <label for="technical_note">{{ trans('cruds.report.fields.technical_notes') }}</label>
                <p class="helper-block">
                    {{ trans('cruds.report.fields.technical_notes_helper') }}
                </p>
                <textarea id="technical_note" name="technical_note"
                    class="form-control">{{ old('technical_note') }}</textarea>
                @if($errors->has('technical_note'))
                <p class="help-block">
                    {{ $errors->first('technical_note') }}
                </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('observer_note') ? 'has-error' : '' }}">
                <label for="observer_note">{{ trans('cruds.report.fields.observer_notes') }}</label>
                <textarea id="observer_note" name="observer_note"
                    class="form-control">{{ old('observer_note') }}</textarea>
                @if($errors->has('observer_note'))
                <p class="help-block">
                    {{ $errors->first('observer_note') }}
                </p>
                @endif
            </div>

            <p id="count">Counter</p>

            <div>
                <input class="btn btn-danger" type="submit" value="Išsaugoti" />
            </div>
        </form>
    </div>
</div>

@endsection
@section('scripts')
<script>
    var countChecked = function () {
        n = $(".point:checked").length;
        total = $(".criterion").length;
        if (n < total) {
            color = "red";
            $("input[type=submit]").attr("disabled", true);
        } else {
            color = "green";
            $("input[type=submit]").attr("disabled", false);
        }
        $("#count").html(
            "<span style='color:" +
                color +
                " '> {{ trans('cruds.report.counter.assessed') }}" +
                n +
                " / " +
                total +
                "</span>"
        );
    };
    countChecked();
    $(".point").on("click", countChecked);
</script>
@endsection