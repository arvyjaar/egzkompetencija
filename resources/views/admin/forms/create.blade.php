@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.add' )}} {{ trans('cruds.form.title_singular' )}}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.forms.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">{{ trans('global.title') }}*</label>
                <input type="text" id="title" name="title" class="form-control"
                    value="{{ old('title', isset($form) ? $form->title : '') }}" required>
                @if($errors->has('title'))
                <p class="help-block">
                    {{ $errors->first('title') }}
                </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('version') ? 'has-error' : '' }}">
                <label for="version">{{ trans('cruds.form.fields.version') }}*</label>
                <input type="text" id="version" name="version" class="form-control"
                    value="{{ old('version', isset($form) ? $form->version : '') }}" required>
                @if($errors->has('version'))
                <p class="help-block">
                    {{ $errors->first('version') }}
                </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('worktype_id') ? 'has-error' : '' }}">
                <label for="worktype_id">{{ trans('cruds.worktype.title') }}*</label>

                <select name="worktype_id" id="worktype_id" class="form-control" required>

                    @foreach($worktypes as $id => $title)
                    <option value="{{ $id }}" {{ old('worktype_id') == $id ? 'selected' : ''}}>
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
            <div class="form-group {{ $errors->has('competencies') ? 'has-error' : '' }}">
                <label for="competencies">{{ trans('cruds.competency.title') }}*
                    <span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label>
                <select name="competencies[]" id="competencies" class="form-control select2" multiple="multiple"
                    required>
                    @foreach($competencies as $competency)
                    <option value="{{ $competency->id }}"
                        {{ (in_array($competency->id, old('competencies', [])) || isset($form) && $form->competency->contains($competency->id)) ? 'selected' : '' }}>
                        {{ $competency->title.', '.$competency->worktype->title  }} </option>
                    @endforeach
                </select>
                @if($errors->has('competencies'))
                <p class="help-block">
                    {{ $errors->first('competencies') }}
                </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('active') ? 'has-error' : '' }}">
                <div class="icheck-primary icheck-inline">
                    <input type="checkbox" name="active" id="active" value="1" {{ old('active') ? 'checked' : '' }}>
                    <label for="active">{{ trans('cruds.form.fields.active') }}</label>
                </div>
                <p class="helper-block">
                    {{ trans('cruds.form.fields.active_helper') }}
                </p>
                @if($errors->has('active'))
                <p class="help-block">
                    {{ $errors->first('active') }}
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