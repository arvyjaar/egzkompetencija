@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header alert alert-warning">
        Redaguojama darbuotojo darbo stebėjimo ataskaita Nr. <b>{{ $report->id }}</b>
    </div>

    <div class="card-body">
        <form action="{{ route("admin.reports.update", [$report->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-4">
                    <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
                        <label for="employee_id">Darbuotojas (-a)*</label>
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
                    <label for="observer_id">Vertintojas (-a)*</label>
                    <input type="text" class="form-control" disabled="disabled"
                        placeholder="{{ $report->observer->name ?? '' }}">
                </div>
                <div class="col-4">
                    <label for="form_id">Forma:*</label>
                    <input type="text" name="form_id" id="form_id" class="form-control"
                        placeholder="{{ $report->form->title }}, v.{{ $report->form->version }}" disabled />
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group {{ $errors->has('drivecategory_id') ? 'has-error' : '' }}">
                        <label for="drivecategory_id">Kategorija*</label>
                        <select type="text" id="drivecategory_id" name="drivecategory_id" class="form-control select2"
                            required>
                            @foreach($drivecategories as $drivecategory)
                            <option value="{{ $drivecategory->id }}"
                                {{ old('drivecategory_id') == $drivecategory->id ? 'selected' : '' }}>
                                {{ $drivecategory->title }}
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
                        <label for="procedure_date">Procedūros data, laikas*</label>
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
                        <label for="observing_date">Stebėjimo data*</label>
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
                        <b>Buvo stebėta*: &nbsp;</b>
                        @foreach($observing_types as $type)
                        <label for="observing_type_{{ $type->id }}">{{ $type->title }}
                        </label>
                        <input type="radio" id="observing_type_{{ $type->id }}" name="observing_type_id"
                            value="{{ $type->id }}"
                            {{ (old('observing_type_id') == $type->id || $report->observing_type_id == $type->id) ? 'checked' : ''}}
                            required />

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
                <div class="col-7">
                    <p class="criterion"> {{ $evaluation->criterion->title }}</p>
                </div>
                <div class="col-5">
                    @foreach(json_decode($evaluation->criterion->assessment->assessment_values) as $point)
                    <label class="custom-label" for="point_cr{{ $evaluation->criterion->id }}_p{{ $point->value }}">
                        {{ $point->title }}
                        <input type="radio" id="point_cr{{ $evaluation->criterion->id }}_p{{ $point->value }}"
                            class="point" name="point[{{ $evaluation->criterion->id }}]" value="{{ $point->value }}"
                            data-evaluation_id="{{ $evaluation->id }}" data-assessment_value="{{ $point->value }}"
                            onclick="updateSingleEvaluation(this)"
                            {{ (old("point.".$evaluation->criterion->id) == $point->value || $evaluation->assessment_value == $point->value) ? 'checked' : ''}}
                            required />
                    </label>
                    @endforeach {{-- end assessment values --}}
                </div>
            </div>
            @endforeach {{-- end evaluations (loop through criteria) --}}

            <div class="row">
                <div class="col-12">
                    <div class="form-group {{ $errors->has('competency_note') ? 'has-error' : '' }}">
                        <label for="competency_note">Pastabos</label>
                        <textarea id="competency_note" name="competency_note[{{ $evaluations->competency_id }}]"
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
                <label for="technical_note">Papildomos/bendrosios pastabos</label>
                <p class="helper-block">
                    Pastabos dėl techninių priemonių, trukdančių efektyviam darbui,
                    nesusijusios su šiuo
                    įvertinimu
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
                <label for="observer_note">Stebėtojo išvados, pasiūlymai</label>
                <textarea id="observer_note" name="observer_note"
                    class="form-control">{{ old('observer_note', isset($report) ? $report->observer_note : '') }}</textarea>
                    
                @if($errors->has('observer_note'))
                <p class="help-block">
                    {{ $errors->first('observer_note') }}
                </p>
                @endif
            </div>

            <p id="count">Įvertinimų skaitliukas</p>

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
                <h5 class="modal-title text-info">Naujas įvertinimas</h5>
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
            $("#count").html("<span style='color:" + color + " '> Įvertinote aspektų: " + n + " iš " + total + "</span>");
        };
        countChecked();
        $(".point").on("click", countChecked);

        // confirm evaluation update wit BS modal
        function updateSingleEvaluation(eval) {
            $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: '{{ route("admin.reports.updateSingleEvaluation", [$report->id]) }}',
                data: {evaluation_id: eval.dataset.evaluation_id, assessment_value: eval.dataset.assessment_value, _method: 'PUT'},
                success: function (data) {
                    $('.modal-title').html(data.success);
                    $("#value-confirmation").modal('show');
                    setTimeout(function () {
                        $("#value-confirmation").modal('hide');
                    }, 2000);
                }
            });
        }
</script>
@endsection