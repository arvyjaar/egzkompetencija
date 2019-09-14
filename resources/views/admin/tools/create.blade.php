@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.tool.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.tools.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                <label for="title">{{ trans('cruds.tool.fields.title') }}*</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($tool) ? $tool->title : '') }}" required>
                @if($errors->has('title'))
                    <p class="help-block">
                        {{ $errors->first('title') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.tool.fields.title_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('model') ? 'has-error' : '' }}">
                <label for="model">{{ trans('cruds.tool.fields.model') }}</label>
                <input type="text" id="model" name="model" class="form-control" value="{{ old('model', isset($tool) ? $tool->model : '') }}">
                @if($errors->has('model'))
                    <p class="help-block">
                        {{ $errors->first('model') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.tool.fields.model_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('condition') ? 'has-error' : '' }}">
                <label for="condition">{{ trans('cruds.tool.fields.condition') }}*</label>
                <input type="text" id="condition" name="condition" class="form-control" value="{{ old('condition', isset($tool) ? $tool->condition : '') }}" required>
                @if($errors->has('condition'))
                    <p class="help-block">
                        {{ $errors->first('condition') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.tool.fields.condition_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('note') ? 'has-error' : '' }}">
                <label for="note">{{ trans('cruds.tool.fields.note') }}</label>
                <textarea id="note" name="note" class="form-control ">{{ old('note', isset($tool) ? $tool->note : '') }}</textarea>
                @if($errors->has('note'))
                    <p class="help-block">
                        {{ $errors->first('note') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.tool.fields.note_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('branch') ? 'has-error' : '' }}">
                <label for="branch">{{ trans('cruds.tool.fields.branch') }}*</label>
                <input type="text" id="branch" name="branch" class="form-control" value="{{ old('branch', isset($tool) ? $tool->branch : '') }}" required>
                @if($errors->has('branch'))
                    <p class="help-block">
                        {{ $errors->first('branch') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.tool.fields.branch_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection