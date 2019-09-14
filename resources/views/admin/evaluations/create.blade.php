@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.evaluation.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.evaluations.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('monitoringreports') ? 'has-error' : '' }}">
                <label for="monitoringreport">{{ trans('cruds.evaluation.fields.monitoringreport') }}*
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="monitoringreports[]" id="monitoringreports" class="form-control select2" multiple="multiple" required>
                    @foreach($monitoringreports as $id => $monitoringreport)
                        <option value="{{ $id }}" {{ (in_array($id, old('monitoringreports', [])) || isset($evaluation) && $evaluation->monitoringreports->contains($id)) ? 'selected' : '' }}>{{ $monitoringreport }}</option>
                    @endforeach
                </select>
                @if($errors->has('monitoringreports'))
                    <p class="help-block">
                        {{ $errors->first('monitoringreports') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.evaluation.fields.monitoringreport_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('criterias') ? 'has-error' : '' }}">
                <label for="criteria">{{ trans('cruds.evaluation.fields.criteria') }}*
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="criterias[]" id="criterias" class="form-control select2" multiple="multiple" required>
                    @foreach($criterias as $id => $criteria)
                        <option value="{{ $id }}" {{ (in_array($id, old('criterias', [])) || isset($evaluation) && $evaluation->criterias->contains($id)) ? 'selected' : '' }}>{{ $criteria }}</option>
                    @endforeach
                </select>
                @if($errors->has('criterias'))
                    <p class="help-block">
                        {{ $errors->first('criterias') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.evaluation.fields.criteria_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('points') ? 'has-error' : '' }}">
                <label for="point">{{ trans('cruds.evaluation.fields.point') }}*
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="points[]" id="points" class="form-control select2" multiple="multiple" required>
                    @foreach($points as $id => $point)
                        <option value="{{ $id }}" {{ (in_array($id, old('points', [])) || isset($evaluation) && $evaluation->points->contains($id)) ? 'selected' : '' }}>{{ $point }}</option>
                    @endforeach
                </select>
                @if($errors->has('points'))
                    <p class="help-block">
                        {{ $errors->first('points') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.evaluation.fields.point_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection