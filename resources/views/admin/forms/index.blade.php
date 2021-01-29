@extends('layouts.admin')
@section('content')
@can('criterion_edit')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.forms.create") }}">
            <i class="far fa-plus-square">&nbsp;</i> {{ trans('cruds.form.title_singular')}}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.form.title') }} - {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.form.title_singular') }}
                        </th>
                        <th>
                            {{ trans('cruds.worktype.title_singular') }}
                        </th>
                        <th>
                            {{ trans('cruds.form.fields.version') }}
                        </th>
                        <th>
                            {{ trans('cruds.form.fields.active') }}
                        </th>
                        <th>
                            {{ trans('cruds.form.fields.has_reports') }}
                        </th>
                        <th>
                            {{ trans('global.actions') }}
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($forms as $form)
                    <tr data-entry-id="{{ $form->id }}">
                        <td>
                            {{ $form->title ?? '' }}
                        </td>
                        <td>
                            {{ $form->worktype->title ?? '' }}
                        </td>
                        <td>
                            {{ $form->version }}
                        </td>
                        <td>
                            {{ $form->active ? trans('global.yes') : '' }}
                        </td>
                        <td>
                            {{ $form->hasReports ? trans('global.yes') : '' }}
                        </td>

                        <td>
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.forms.show', $form->id) }}">
                                <i class="far fa-eye"></i>
                            </a>
                            @if (!$form->hasReports)
                            @can('criterion_edit')
                            <a class="btn btn-sm btn-info" href="{{ route('admin.forms.edit', $form->id) }}">
                                <i class="far fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.forms.destroy', $form->id) }}" method="POST"
                                onsubmit="return confirm('Ar tikrai trinti?');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                            </form>
                            @endcan
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
$(function () {
    $('.datatable').DataTable({
        pageLength: 25,
    });
})
</script>
@endsection