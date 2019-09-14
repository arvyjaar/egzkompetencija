@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.point.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.points.update", [$point->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">{{ trans('cruds.point.fields.description') }}*</label>
                <input type="text" id="description" name="description" class="form-control" value="{{ old('description', isset($point) ? $point->description : '') }}" required>
                @if($errors->has('description'))
                    <p class="help-block">
                        {{ $errors->first('description') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.point.fields.description_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('value') ? 'has-error' : '' }}">
                <label for="value">{{ trans('cruds.point.fields.value') }}*</label>
                <input type="text" id="value" name="value" class="form-control" value="{{ old('value', isset($point) ? $point->value : '') }}" required>
                @if($errors->has('value'))
                    <p class="help-block">
                        {{ $errors->first('value') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.point.fields.value_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection