@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.statistics.title') }}
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="date_from">{{ trans('cruds.statistics.date_from') }}</label>
                    <input type="text" id="date_from" name="date_from" class="form-control date"
                        value="{{ old('date_from') }}" required>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="date_to">{{ trans('cruds.statistics.date_to') }}</label>
                    <input type="text" id="date_to" name="date_to" class="form-control date"
                        value="{{ old('date_to') }}" required>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="worktype_id">{{ trans('cruds.worktype.title_singular') }}</label>
                    <select name="worktype_id" id="worktype_id" class="form-control" required>
                        @foreach($worktypes as $id => $title)
                        <option value="{{ $id }}" {{ old('worktype_id') == $id ? 'selected' : ''}}>
                            {{ $title }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="branch_id">{{ trans('cruds.branch.title_singular') }}</label>
                    <select name="branch_id" id="worktype_id" class="form-control" required>
                        @foreach($branches as $id => $title)
                        <option value="{{ $id }}" {{ old('branch_id') == $id ? 'selected' : ''}}>
                            {{ $title }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div> <!-- /row -->
        <div class="row">
            <div class="col-12">
                {!! $html->table(['class' => 'table table-bordered table-stripped table-hover'], true) !!}
            </div>

        </div> <!-- / card body -->
    </div> <!-- / card -->
@endsection
@section('scripts')
@parent
    <script>
        $('#dataTableBuilder').DataTable({
            processing: true,
            serverSide: true,
            pageLength: 50,
            ajax: "{{ route('admin.stats.index') }}",
            columns: [               
                {data: 'name', name: 'name'},
                {data: 'branch.title', name: 'branch.title'},
            ],
            dom: 'lBfrtip',
            buttons: ['csv', 'print', 'colvis'],
            initComplete: function () {
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
    </script>
@endsection