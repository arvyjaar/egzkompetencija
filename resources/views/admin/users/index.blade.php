@extends('layouts.admin')
@section('content')
@can('create', \App\Models\User::class)
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.users.create") }}">
            <i class="far fa-plus-square">&nbsp;</i> {{ trans('cruds.user.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.user.title') }} - {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable">
            <thead>
                <tr>
                    <th>
                        {{ trans('cruds.user.fields.name') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.branch') }}
                    </th>
                    <th>
                        {{ trans('global.actions') }}
                    </th>
                </tr>
            </thead>
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
            processing: true,
            serverSide: true,
            pageLength: 25,
            orderCellsTop: true,
            fixedHeader: true,
            ajax: "{{ route('admin.users.index') }}",
            dom: 'lBfrtip',
            buttons: ['csv', 'print', 'colvis'],
            columns: [
                {data: 'name', name: 'name'},
                {data: 'branch.title', name: 'branch.title'},
                {data: 'actions', name: 'actions', orderable: false, searchable: false}
            ],
        });
});
</script>
@endsection