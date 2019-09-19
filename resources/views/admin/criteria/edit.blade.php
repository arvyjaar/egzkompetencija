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
            <div class="form-group {{ $errors->has('critcategory_id') ? 'has-error' : '' }}">
                <label for="critcategory_id">{{ trans('cruds.criterion.fields.category') }}*</label>
                <select name="critcategory_id" id="critcategory_id" class="form-control select2" required>
                    @foreach($critcategories as $id => $critcategory)
                        <option value="{{ $id }}" {{ old('critcategory_id', $criterion->critcategory_id) == $id ? 'selected' : '' }} > {{ $critcategory }} </option>
                    @endforeach
                </select>
                @if($errors->has('critcategory_id'))
                    <p class="help-block">
                        {{ $errors->first('critcategory_id') }}
                    </p>
                @endif
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection