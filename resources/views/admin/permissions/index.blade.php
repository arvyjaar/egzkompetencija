@extends('layouts.admin')
@section('content')
@can('create', \App\Models\Permission::class)
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.permissions.create") }}">
                <i class="far fa-plus-square">&nbsp;</i> {{ trans('cruds.permission.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.permission.title') }} - {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.permission.fields.title') }}
                        </th>
                        <th width="100">
                            {{ trans('global.actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $key => $permission)
                        <tr data-entry-id="{{ $permission->id }}">
                            <td>
                                {{ $permission->title ?? '' }}
                            </td>
                            <td>
                                @can('view', $permission)
                                    <a class="btn btn-sm btn-primary" href="{{ route('admin.permissions.show', $permission->id) }}">
                                        <i class="far fa-eye"></i>
                                    </a>
                                @endcan
                                @can('update', $permission)
                                    <a class="btn btn-sm btn-info" href="{{ route('admin.permissions.edit', $permission->id) }}">
                                        <i class="far fa-edit"></i>
                                    </a>
                                @endcan
                                @can('delete', $permission)
                                    <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endcan
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
    $('.datatable').DataTable()
})
</script>
@endsection