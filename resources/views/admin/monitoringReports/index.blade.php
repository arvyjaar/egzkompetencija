@extends('layouts.admin')
@section('content')
    @can('monitoring_report_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.monitoring-reports.create") }}">
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

                    </th>
                    <th>
                        Stebėtojas
                    </th>
                    <th>
                        Egzaminuotojas
                    </th>

                    <th>
                        Filialas
                    </th>
                    <th>
                        Egzaminas
                    </th>
                    <th>
                        Kategorija
                    </th>
                    <th>
                        Stebėta
                    </th>
                    <th>
                        Tipas
                    </th>
                    <th>
                        Egzaminuotojas susipažino
                    </th>
                    <th>
                        &nbsp;
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
                url: "{{ route('admin.monitoring-reports.massDestroy') }}",
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
            @can('monitoring_report_delete')
              dtButtons.push(deleteButton)
                    @endcan

            let dtOverrideGlobals = {
                        buttons: dtButtons,
                        processing: true,
                        serverSide: true,
                        retrieve: true,
                        aaSorting: [],
                        ajax: "{{ route('admin.monitoring-reports.index') }}",
                        columns: [
                            {data: 'placeholder', name: 'placeholder'},
                            {data: 'observer', name: 'observer.name'},
                            {data: 'examiner', name: 'examiner.name'},
                            //{ data: 'user.email', name: 'user.email' },
                            {data: 'branch', name: 'branch.title'},
                            {data: 'exam_date', name: 'exam_date'},
                            {data: 'drivecategory', name: 'drivecategory'},
                            {data: 'observing_date', name: 'observing_date'},
                            {data: 'observing_type', name: 'observing_type'},
                            {data: 'examiner_reviewed', name: 'examiner_reviewed'},
                            {data: 'actions', name: '{{ trans('global.actions') }}'}
                        ],
                    };

            $('.datatable').DataTable(dtOverrideGlobals);

        });

    </script>
@endsection