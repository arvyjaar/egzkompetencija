@extends('layouts.admin')
@section('content')
@can('criterion_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.criteria.create") }}">
                Naujas darbo aspektas
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        Darbo aspektų sąrašas
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            Pavadinimas
                        </th>
                        <th>
                            Kompetencija
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($criteria as $key => $criterion)
                        <tr data-entry-id="{{ $criterion->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $criterion->title ?? '' }}
                            </td>
                            <td>
                                {{ $criterion->competency->title ?? '' }}
                            </td>
                            <td>
                                @can('is_admin')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.criteria.show', $criterion->id) }}">
                                        Rodyti
                                    </a>
                                @endcan
                                @can('is_admin')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.criteria.edit', $criterion->id) }}">
                                        Taisyti
                                    </a>
                                @endcan
                                @can('is_admin')
                                    <form action="{{ route('admin.criteria.destroy', $criterion->id) }}" method="POST" onsubmit="return confirm('Ar tikrai trinti?');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="Trinti">
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
    url: "{{ route('admin.criteria.massDestroy') }}",
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
@can('criterion_delete')
  dtButtons.push(deleteButton)
@endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

</script>
@endsection