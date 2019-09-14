@extends('layouts.admin')
@section('content')
@can('tool_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.tools.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.tool.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.tool.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.tool.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.tool.fields.model') }}
                        </th>
                        <th>
                            {{ trans('cruds.tool.fields.condition') }}
                        </th>
                        <th>
                            {{ trans('cruds.tool.fields.note') }}
                        </th>
                        <th>
                            {{ trans('cruds.tool.fields.branch') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tools as $key => $tool)
                        <tr data-entry-id="{{ $tool->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $tool->title ?? '' }}
                            </td>
                            <td>
                                {{ $tool->model ?? '' }}
                            </td>
                            <td>
                                {{ $tool->condition ?? '' }}
                            </td>
                            <td>
                                {{ $tool->note ?? '' }}
                            </td>
                            <td>
                                {{ $tool->branch->title ?? '' }}
                            </td>
                            <td>
                                @can('tool_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.tools.show', $tool->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan
                                @can('tool_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.tools.edit', $tool->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan
                                @can('tool_delete')
                                    <form action="{{ route('admin.tools.destroy', $tool->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
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
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tools.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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
@can('tool_delete')
  dtButtons.push(deleteButton)
@endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

</script>
@endsection