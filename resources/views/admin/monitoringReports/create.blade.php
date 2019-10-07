@extends('layouts.admin')
@section('content')

    <div class="card">

        <div class="card-header alert alert-info">
            Nauja egzaminuotojo darbo stebėjimo ataskaita
        </div>

        <div class="card-body">

            <form action="{{ route("admin.monitoring-reports.store") }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="form-group {{ $errors->has('branch_id') ? 'has-error' : '' }}">
                            <label for="branch_id">Filialas*</label>
                            <select name="branch_id" id="branch_id" class="form-control select2"
                                    required>
                                @foreach($branches as $id => $branch)
                                    <option value="{{ $id }}" {{ (isset($monitoringReport) && $monitoringReport->branch ? $monitoringReport->branch->id : old('branch_id')) == $id ? 'selected' : '' }}>{{ $branch }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('branch_id'))
                                <p class="help-block">
                                    {{ $errors->first('branch_id') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group {{ $errors->has('user_id') ? 'has-error' : '' }}">
                            <label for="examiner_id">Egzaminuotojas (-a)*</label>
                            <select name="examiner_id" id="examiner_id"
                                    class="form-control select2">
                                @foreach($users as $id => $user)
                                    <option value="{{ $id }}" {{ (isset($monitoringReport) && $monitoringReport->examiner ? $monitoringReport->examiner->id : old('examiner_id')) == $id ? 'selected' : '' }}>{{ $user }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('examiner_id'))
                                <p class="help-block">
                                    {{ $errors->first('examiner_id') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="observer_id">Stebėtojas (-a)*</label>
                        <input type="text" class="form-control" disabled="disabled"
                               placeholder="{{ auth()->user()->name }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group {{ $errors->has('category') ? 'has-error' : '' }}">
                            <label for="drivecategory">Kategorija*</label>
                            <select type="text" id="drivecategory" name="drivecategory"
                                    class="form-control select2"
                                    required>
                                @foreach(App\MonitoringReport::CATEGORIES as $drivecategory)
                                    <option value="{{ $drivecategory }}" {{ (isset($monitoringReport) && $monitoringReport->drivecategory ? $monitoringReport->drivecategory : old('drivecategory')) == $drivecategory ? 'selected' : '' }}>{{ $drivecategory }}</option>
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
                        <div class="form-group {{ $errors->has('exam_date') ? 'has-error' : '' }}">
                            <label for="exam_date">Egzamino data, laikas*</label>
                            <input type="text" id="exam_date" name="exam_date"
                                   class="form-control datetime"
                                   value="{{ old('exam_date', isset($monitoringReport) ? $monitoringReport->exam_date : '') }}"
                                   required>
                            @if($errors->has('exam_date'))
                                <p class="help-block">
                                    {{ $errors->first('exam_date') }}
                                </p>
                            @endif
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group {{ $errors->has('observing_date') ? 'has-error' : '' }}">
                            <label for="observing_date">Stebėjimo data*</label>
                            <input type="text" id="observing_date" name="observing_date"
                                   class="form-control date"
                                   value="{{ old('observing_date', isset($monitoringReport) ? $monitoringReport->observing_date : '') }}"
                                   required>
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
                        <div class="form-group {{ $errors->has('observing_type') ? 'has-error' : '' }}">
                            <b>Stebėtas*: &nbsp;</b>
                            @foreach(App\MonitoringReport::OBSERVING_TYPE_RADIO as $key => $label)
                                <label class="custom-label" for="observing_type_{{ $key }}">{{ $label }}
                                <input type="radio" id="observing_type_{{ $key }}"
                                       name="observing_type"
                                       value="{{ $key }}"
                                       {{ old('observing_type', isset($monitoringReport) && ($monitoringReport->observing_type) === (string)$key) ? 'checked' : '' }}
                                       required>
                                </label>
                            @endforeach
                            @if($errors->has('observing_type'))
                                <p class="help-block">
                                    {{ $errors->first('observing_type') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="">
                    <label>Vertinimas:</label>
                    <p>
                        @foreach($points as $point)
                            {{ $point->value == 0 ? 'N' : $point->value }} - {{ $point->title }},&nbsp;
                        @endforeach
                    </p>
                    <hr>
                </div>

                @foreach($competencies as $competency)
                    {{-- there goes competencies and competency notes --}}
                    <div class="row">
                        <div class="col-12">
                            <strong>{{ $competency->title }}</strong>
                        </div>
                    </div>
                    @foreach($competency->criterion as $criterion)
                        {{-- there goes evaluations --}}
                        <div class="row">
                            <div class="col-7">
                                <p class="criterion">{{ $criterion->title }}</p>
                            </div>
                            <div class="col-5">

                                @foreach($points as $point)
                                    {{-- there goes points for each evaluation --}}
                                    <label class="custom-label"
                                           for="point_cr{{ $criterion->id }}_p{{ $point->id }}"> {{ $point->value == 0 ? 'N' : $point->value }}
                                    <input type="radio"
                                           id="point_cr{{ $criterion->id }}_p{{ $point->id }}"
                                           class="point"
                                           name="point[{{ $criterion->id }}]"
                                           value="{{ $point->id }}"
                                           {{ $point->id == old('point.'.$criterion->id) ? ' checked' : '' }}
                                           required>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    <div class="form-group {{ $errors->has('competency_note') ? 'has-error' : '' }}">
                        <label for="competency_note">Pastabos</label>
                        <textarea id="competency_note"
                                  name="competency_note[{{ $competency->id }}]"
                                  class="form-control">{{ old('competency_note.'.$competency->id) }}
                                    </textarea>
                        @if($errors->has('competency_note'))
                            <p class="help-block">
                                {{ $errors->first('competency_note.*') }}
                            </p>
                        @endif
                    </div>
                @endforeach

                <div class="form-group {{ $errors->has('technical_note') ? 'has-error' : '' }}">
                    <label for="technical_note">Papildomos/bendrosios pastabos</label>
                    <p class="helper-block">
                        Pastabos dėl techninių priemonių, trukdančių efektyviam darbui,
                        nesusijusios su šiuo
                        įvertinimu
                    </p>
                    <textarea id="technical_note" name="technical_note"
                              class="form-control">{{ old('technical_note', isset($monitoringReport) ? $monitoringReport->technical_note : '') }}
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
                              class="form-control">{{ old('observer_note', isset($monitoringReport) ? $monitoringReport->observer_note : '') }}</textarea>
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
        </div>
    </div>

@endsection
@section('scripts')
    <script>
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
    </script>
@endsection