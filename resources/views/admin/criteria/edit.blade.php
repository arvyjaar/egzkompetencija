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
                    @foreach($competencies as $competency)
                        <option value="{{ $competency->id }}" 
                            {{ old('competency_id', $criterion->competency_id) == $competency->id ? 'selected' : '' }} 
                            > 
                            {{ $competency->title }} ({{ $competency->worktype->title }})</option>
                    @endforeach
                </select>
                @if($errors->has('competency_id'))
                    <p class="help-block">
                        {{ $errors->first('competency_id') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('assessment_type_id') ? 'has-error' : '' }}">
                <label for="assessment_type">{{ trans('cruds.assessment_type.title') }}*</label>
                <select name="assessment_type_id" id="assessment_type_id" class="form-control" >
                    @foreach($assessment_types as $assessment_type)
                    <option value="{{ $assessment_type->id }}" 
                        {{ old('assessment_type_id', $criterion->assessment_type_id) == $assessment_type->id ? 'selected' : ''}} > 
                        {{ $assessment_type->title }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('assessment_type_id'))
                    <p class="help-block">
                        {{ $errors->first('assessment_type_id') }}
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