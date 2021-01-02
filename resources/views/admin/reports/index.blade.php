@extends('layouts.admin')
@section('content')
    @can('report_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.reports.create") }}">
                    Sukurti stebėjimo ataskaitą
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
                    <th width="10">
                        &#9633; {{-- square --}}
                    </th>
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
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>

        $(function () {

            let deleteButtonTrans = 'Ištrinti pažymėtus';
            let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.reports.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).data(), function (entry) {
                        return entry.id
                    });

                    if (ids.length === 0) {
                        alert('Nieko nepažymėjote')

                        return
                    }

                    if (confirm('Ar tikrai ištrinti?')) {
                        $.ajax({
                            headers: {'x-csrf-token': _token},
                            method: 'POST',
                            url: config.url,
                            data: {ids: ids, _method: 'DELETE'}
                        })
                                .done(function () {
                                    location.reload()
                                })
                    }
                }
            };

            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('is_admin')
              dtButtons.push(deleteButton)
            @endcan

            let dtOverrideGlobals = {
                        buttons: dtButtons,
                        processing: true,
                        serverSide: true,
                        retrieve: true,
                        aaSorting: [],
                        ajax: "{{ route('admin.reports.index') }}",
                        columns: [
                            {data: 'placeholder', name: 'placeholder'},
                            {data: 'observer.name', name: 'observer.name'},
                            {data: 'employee.name', name: 'employee.name'},
                            {data: 'observing_date', name: 'observing_date'},
                            {data: 'employee_reviewed_at', name: 'employee_reviewed_at'},
                            {data: 'actions', name: 'Veiksmai'}
                        ],
                    };

            $('.datatable').DataTable(dtOverrideGlobals);

        });

    </script>
@endsection