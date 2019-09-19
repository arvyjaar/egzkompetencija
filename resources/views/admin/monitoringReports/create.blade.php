@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            Nauja egzaminuotojo darbo stebėjimo ataskaita
        </div>

        <div class="card-body">
            <form action="{{ route("admin.monitoring-reports.store") }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-4">
                        <div class="form-group {{ $errors->has('branch_id') ? 'has-error' : '' }}">
                            <label for="branch_id">Filialas*</label>
                            <select name="branch_id" id="branch_id" class="form-control select2" required>
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
                            <select name="examiner_id" id="examiner_id" class="form-control select2" required>
                                @foreach($users as $id => $user)
                                    <option value="{{ $id }}" {{ (isset($monitoringReport) && $monitoringReport->user ? $monitoringReport->user->id : old('examiner_id')) == $id ? 'selected' : '' }}>{{ $user }}</option>
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
                            <label for="category">Kategorija*</label>
                            <select type="text" id="category" name="category" class="form-control select2" required>
                                @foreach(App\MonitoringReport::CATEGORIES as $category)
                                    <option value="{{ $category }}" {{ (isset($monitoringReport) && $monitoringReport->category ? $monitoringReport->category : old('category')) == $category ? 'selected' : '' }}>{{ $category }}</option>
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
                            <input type="text" id="exam_date" name="exam_date" class="form-control datetime"
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
                            <label for="observing_date">Stebėjimo data*
                                *</label>
                            <input type="text" id="observing_date" name="observing_date" class="form-control date"
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
                            <label>Stebėtas*: &nbsp;</label>
                            @foreach(App\MonitoringReport::OBSERVING_TYPE_RADIO as $key => $label)
                                &nbsp; {{ $label }} &nbsp;
                                <input type="radio" id="observing_type_{{ $key }}" name="observing_type"
                                       value="{{ $key }}"
                                       {{ old('observing_type', 1) === (string)$key ? 'checked' : '' }} required>
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
                        {{ $point->value == 0 ? 'N' : $point->value }} - {{ $point->title }};
                    @endforeach
                    </p>
                    <hr>
                </div>

                @foreach($critcategories as $critcategory)
                    <div class="row">
                        <div class="col-12">
                            <strong>{{ $critcategory->title }}</strong>
                        </div>
                     </div>
                    @foreach($critcategory->criteria as $criteria)
                    <div class="row">
                        <div class="col-7">
                            <p>{{ $criteria->title }}</p>
                        </div>
                        <div class="col-5">
                            @foreach($points as $point)
                                &nbsp; {{ $point->value == 0 ? 'N' : $point->value }} &nbsp;
                                <input type="radio" id="point_{{ $point->id }}" name="point[{{ $criteria->id }}]" value="{{ $point->id }}" >
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                @endforeach

                <div class="form-group {{ $errors->has('technical_notes') ? 'has-error' : '' }}">
                    <label for="technical_notes">Papildomos/bendrosios pastabos</label>
                    <p class="helper-block">
                        Pastabos dėl techninių priemonių, trukdančių efektyviam darbui, nesusijusios su šiuo įvertinimu
                    </p>
                    <textarea id="technical_notes" name="technical_notes"
                              class="form-control">{{ old('technical_notes', isset($monitoringReport) ? $monitoringReport->technical_notes : '') }}
                    </textarea>
                    @if($errors->has('technical_notes'))
                        <p class="help-block">
                            {{ $errors->first('technical_notes') }}
                        </p>
                    @endif

                </div>
                <div class="form-group {{ $errors->has('observer_notes') ? 'has-error' : '' }}">
                    <label for="observer_notes">Stebėtojo išvados, pasiūlymai</label>
                    <textarea id="observer_notes" name="observer_notes"
                              class="form-control ckeditor">{{ old('observer_notes', isset($monitoringReport) ? $monitoringReport->observer_notes : '') }}</textarea>
                    @if($errors->has('observer_notes'))
                        <p class="help-block">
                            {{ $errors->first('observer_notes') }}
                        </p>
                    @endif

                </div>
                <div>
                    <input class="btn btn-danger" type="submit" value="Išsaugoti">
                </div>
            </form>
        </div>
    </div>
@endsection