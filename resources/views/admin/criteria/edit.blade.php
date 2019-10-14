@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.criterion.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.criteria.update", [$criterion->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">{{ trans('cruds.criterion.fields.title') }}*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($criterion) ? $criterion->title : '') }}" required>
                @if($errors->has('title'))
                    <p class="help-block">
                        {{ $errors->first('title') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.criterion.fields.title_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('competency_id') ? 'has-error' : '' }}">
                <label for="competency_id">{{ trans('cruds.criterion.fields.category') }}*</label>
                <select name="competency_id" id="competency_id" class="form-control select2" required>
                    @foreach($competencies as $id => $competency)
                        <option value="{{ $id }}" {{ old('competency_id', $criterion->competency_id) == $id ? 'selected' : '' }} > {{ $competency }} </option>
                    @endforeach
                </select>
                @if($errors->has('competency_id'))
                    <p class="help-block">
                        {{ $errors->first('competency_id') }}
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