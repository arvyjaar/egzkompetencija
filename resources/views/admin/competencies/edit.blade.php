@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <i class="far fa-edit"></i> {{ trans('cruds.competency.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.competencies.update", [$competency->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">{{ trans('cruds.competency.title') }}*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($competency) ? $competency->title : '') }}" required> 
                @if($errors->has('title'))
                    <p class="help-block">
                        {{ $errors->first('title') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('worktype_id') ? 'has-error' : '' }}">
                <label for="worktype_id">{{ trans('cruds.worktype.title') }}*</label>
                <select name="worktype_id" id="worktype_id" class="form-control select2" required>
                    @foreach($worktypes as $id => $title)
                        <option value="{{ $id }}" {{ old('worktype_id', $competency->worktype_id) == $id ? 'selected' : ''}} >
                        {{ $title }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has('worktype_id'))
                    <p class="help-block">
                        {{ $errors->first('worktype_id') }}
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