@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header alert alert-warning">
        <i class="far fa-edit"></i> {{ trans('cruds.report.title_singular') }} Nr. <b>{{ $report->id }}</b>
    </div>

    <div class="card-body">
        <form action="{{ route("admin.reports.update", [$report->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-4">
                    <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
                        <label for="employee_id">{{ trans('cruds.report.fields.employee') }}*</label>
                        <select name="employee_id" id="employee_id" class="form-control select2">
                            @foreach($users as $id => $user)
                            <option value="{{ $id }}"
                                {{ ($report->employee ? $report->employee->id : old('employee_id')) == $id ? 'selected' : '' }}>
                                {{ $user }}</option>
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
                        placeholder="{{ $report->observer->name ?? '' }}">
                </div>
                <div class="col-4">
                    <label for="form_id">{{ trans('cruds.form.title_singular') }}*</label>
                    <input type="text" name="form_id" id="form_id" class="form-control"
                        placeholder="{{ $report->form->title }}, v.{{ $report->form->version }}" disabled />
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group {{ $errors->has('drivecategory_id') ? 'has-error' : '' }}">
                        <label for="drivecategory_id">{{ trans('cruds.report.fields.category') }}*</label>
                        <select type="text" id="drivecategory_id" name="drivecategory_id" class="form-control select2"
                            required>
                            @foreach($drivecategories as $id => $title)
                            <option value="{{ $id }}"
                                {{ (old('drivecategory_id') == $id || $report->drivecategory_id == $id) ? 'selected' : ''}}>
                                {{ $title }}
                            </option>
                            @endforeach
                        </select>
                        @if($errors->has('category'))
                        <p class="help-block">
                            {{ $errors->first('category') }}
                        </p>
                        @endif
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group {{ $errors->has('procedure_date') ? 'has-error' : '' }}">
                        <label for="procedure_date">{{ trans('cruds.report.fields.procedure_datetime') }}*</label>
                        <input type="text" id="procedure_date" name="procedure_date" class="form-control datetime"
                            value="{{ old('procedure_date', $report->procedure_date ?? '') }}" required>
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
                            value="{{ old('observing_date', $report->observing_date ?? '') }}" required>
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
                        @foreach($observing_types as $type)
                        <div class="icheck-primary icheck-inline">
                            <input type="radio" id="observing_type_{{ $type->id }}" name="observing_type_id"
                            value="{{ $type->id }}"
                            {{ (old('observing_type_id') == $type->id || $report->observing_type_id == $type->id) ? 'checked' : ''}}
                            required />
                            <label for="observing_type_{{ $type->id }}">{{ $type->title }}</label>
                        </div>
                        @endforeach @if($errors->has('observing_type_id'))
                        <p class="help-block">
                            {{ $errors->first('observing_type_id') }}
                        </p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- there goes competencies and competency notes --}}
            @foreach($evaluation_set as $competency_title => $evaluations)
            <div class="row">
                <div class="col-12">
                    <strong>{{ $competency_title }}</strong>
                </div>
            </div>

            @foreach($evaluations as $evaluation)
            <div class="row">
                <div class="col-6">
                    <p class="criterion"> {{ $evaluation->criterionWithTrashed->title }}</p>
                </div>
                <div class="col-6">
                    @foreach(json_decode($evaluation->criterionWithTrashed->assessment->assessment_values) as $point)
                    <div class="icheck-primary icheck-inline">
                        <input type="radio"
                            id="point_cr{{ $evaluation->criterionWithTrashed->id }}_p{{ $point->value }}" class="point"
                            name="point[{{ $evaluation->criterionWithTrashed->id }}]" value="{{ $point->value }}"
                            data-evaluation_id="{{ $evaluation->id }}" 
                            data-assessment_value="{{ $point->value }}"
                            onclick="updateSingleEvaluation(this)"
                            {{ (old("point.".$evaluation->criterionWithTrashed->id) == $point->value || $evaluation->assessment_value == $point->value) ? 'checked' : ''}}
                            required />
                        <label class="custom-label"
                            for="point_cr{{ $evaluation->criterionWithTrashed->id }}_p{{ $point->value }}">
                            {{ $point->title }}
                        </label>
                    </div>
                    @endforeach {{-- end assessment values --}}
                </div>
            </div>
            @endforeach {{-- end evaluations (loop through criteria) --}}

            <div class="row">
                <div class="col-12">
                    <div class="form-group {{ $errors->has('competency_note') ? 'has-error' : '' }}">
                        <label for="competency_note">{{ trans('cruds.report.fields.notes') }}</label>
                        <textarea id="competency_note_{{ $evaluations->competency_id }}" name="competency_note[{{ $evaluations->competency_id }}]"
                            class="form-control">{{ old('competency_note.'.$evaluations->competency_id, $evaluations->competency_note ?? '') }}</textarea>

                        @if($errors->has('competency_note'))
                        <p class="help-block">
                            {{ $errors->first('competency_note.*') }}
                        </p>
                        @endif
                    </div>
                    <hr>
                </div>
            </div>
            @endforeach {{-- end competencies --}}

            <div class="form-group {{ $errors->has('technical_note') ? 'has-error' : '' }}">
                <label for="technical_note">{{ trans('cruds.report.fields.technical_notes') }}</label>
                <p class="helper-block">
                    {{ trans('cruds.report.fields.technical_notes_helper') }}
                </p>
                <textarea id="technical_note" name="technical_note"
                    class="form-control">{{ old('technical_note', isset($report) ? $report->technical_note : '') }}
                </textarea>
                @if($errors->has('technical_note'))
                <p class="help-block">
                    {{ $errors->first('technical_note') }}
                </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('observer_note') ? 'has-error' : '' }}">
                <label for="observer_note">{{ trans('cruds.report.fields.observer_notes') }}</label>
                <textarea id="observer_note" name="observer_note"
                    class="form-control">{{ old('observer_note', isset($report) ? $report->observer_note : '') }}</textarea>

                @if($errors->has('observer_note'))
                <p class="help-block">
                    {{ $errors->first('observer_note') }}
                </p>
                @endif
            </div>

            <p id="count">Counter</p>

            <div>
                <input class="btn btn-danger" type="submit" value="Išsaugoti">
            </div>
        </form>
    </div> <!-- / card-body -->
</div> <!-- / card -->
{{--Auto dissapearing alert after updated evaluation--}}
<div class="modal fade" id="value-confirmation" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-info">{{ trans('cruds.report.new_value') }}: <span id=json-value></span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // count checked (evaluated) criteria
        var countChecked = function () {
            n = $(".point:checked").length;
            total = $(".criterion").length;
            if (n < total) {
                color = 'red';
                $('input[type=submit]').attr('disabled', true);
            } else {
                color = 'green';
                $('input[type=submit]').attr('disabled', false);
            }
            $("#count").html("<span style='color:" + color + " '> {{ trans('cruds.report.counter.assessed') }} " + n + " / " + total + "</span>");
        };
        countChecked();
        $(".point").on("click", countChecked);

        // confirm evaluation update wit BS modal
        function updateSingleEvaluation(eval) {
            $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: '{{ route("admin.reports.updateSingleEvaluation", [$report->id]) }}',
                data: {
                    evaluation_id: eval.dataset.evaluation_id, 
                    assessment_value: eval.dataset.assessment_value,
                    _method: 'PUT'},
                success: function (data) {
                    $('#json-value').html(data.result);
                    $("#value-confirmation").modal('show');
                    setTimeout(function () {
                        $('#json-value').html(''); // unset result
                        $("#value-confirmation").modal('hide');
                    }, 2000);
                }
            });
        }
</script>
@endsection