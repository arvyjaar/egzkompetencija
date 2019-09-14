@extends('layouts.admin')
@section('content')
@can('monitoring_report_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.monitoring-reports.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.monitoringReport.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.monitoringReport.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.monitoringReport.fields.observer') }}
                    </th>
                    <th>
                        {{ trans('cruds.monitoringReport.fields.user') }}
                    </th>
                    <th>
                        {{ trans('cruds.user.fields.email') }}
                    </th>
                    <th>
                        {{ trans('cruds.monitoringReport.fields.branch') }}
                    </th>
                    <th>
                        {{ trans('cruds.monitoringReport.fields.exam_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.monitoringReport.fields.category') }}
                    </th>
                    <th>
                        {{ trans('cruds.monitoringReport.fields.observing_date') }}
                    </th>
                    <th>
                        {{ trans('cruds.monitoringReport.fields.observing_type') }}
                    </th>
                    <th>
                        {{ trans('cruds.monitoringReport.fields.technical_notes') }}
                    </th>
                    <th>
                        {{ trans('cruds.monitoringReport.fields.examiner_reviewed') }}
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
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.monitoring-reports.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }

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
      { data: 'placeholder', name: 'placeholder' },
      { data: 'observer', name: 'observer' },
{ data: 'user.user', name: 'user.name' },
{ data: 'user.email', name: 'user.email' },
{ data: 'branch', name: 'branch' },
{ data: 'exam_date', name: 'exam_date' },
{ data: 'category', name: 'category' },
{ data: 'observing_date', name: 'observing_date' },
{ data: 'observing_type', name: 'observing_type' },
{ data: 'technical_notes', name: 'technical_notes' },
{ data: 'examiner_reviewed', name: 'examiner_reviewed' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
  };

  $('.datatable').DataTable(dtOverrideGlobals);

});

</script>
@endsection