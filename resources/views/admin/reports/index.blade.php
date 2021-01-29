@extends('layouts.admin')
@section('content')
@can('report_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.reports.create") }}">
            <i class="far fa-plus-square">&nbsp;</i> {{ trans('cruds.report.title_singular') }}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        Stebėjimo ataskaitos
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable">
            <thead>
                <tr>
                    <th>
                        Stebėtojas
                    </th>
                    <th>
                        Darbuotojas
                    </th>
                    <th>
                        Stebėjimo data
                    </th>
                    <th>
                        Darbuotojas susipažino
                    </th>
                    <th>
                        {{ trans('global.actions') }}
                    </th>
                </tr>
                <tr>
                    <th class="thead2 filterhead">
                        
                    </th>
                    <th class="thead2 filterhead">
                        
                    </th>
                    <th class="thead2 filterhead">
                        
                    </th>
                    <th class="thead2 filterhead">
                        
                    </th>
                    <th>
                        
                    </th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td>
                        1
                    </td>
                    <td>
                        2
                    </td>
                    <td>
                        3
                    </td>
                    <td>
                        4
                    </td>
                    <td>
                        5
                    </td>
                </tr>
            </tfoot>
        </table>
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
        ajax: "{{ route('admin.reports.index') }}",
        columns: [
            {data: 'observer.name', name: 'observer.name'},
            {data: 'employee.name', name: 'employee.name'},
            {data: 'observing_date', name: 'observing_date'},
            {data: 'employee_reviewed_at', name: 'employee_reviewed_at'},
            {data: 'actions', name: 'Veiksmai', orderable: false, searchable: false}
        ],
        dom: 'lBfrtip',
        buttons: ['csv', 'print', 'colvis'],
        initComplete: function () { 
            let col_count = this.api().columns(':visible').count(); // count visible columns
            this.api().columns().every(function () {
                var column = this;
                var input = document.createElement('input');
                $(input).appendTo($(column.footer()).empty()).on('keyup', function () {
                    var val = $.fn.dataTable.util.escapeRegex($(this).val());
                    column.search(val ? val : '', true, false).draw();
                });
            });
        }
    });
});

</script>
@endsection