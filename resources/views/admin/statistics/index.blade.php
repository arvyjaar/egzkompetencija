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
                    <input type="text" id="date_from" name="date_from" class="form-control date" value="">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="date_to">{{ trans('cruds.statistics.date_to') }}</label>
                    <input type="text" id="date_to" name="date_to" class="form-control date" value="">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="branch_id">{{ trans('cruds.branch.title_singular') }}</label>
                    <select name="branch_id" id="branch_id" class="form-control" required>
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
            <div class="col-1">
                <button class="btn btn-outline-primary" id="go">
                    {{ trans('global.search') }}
                </button>
            </div>
            <div class="col-3 col-offset-2">
                <b><span class="search_params">....</span></b>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <p></p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                {!! $html->table(['class' => 'table table-bordered table-stripped table-hover'], true) !!}
            </div>
        </div>

    </div> <!-- / card body -->
</div> <!-- / card -->
@endsection
@section('scripts')
@parent
<script>
    $(function () {
    var table = $('#dataTableBuilder').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 25,
        ajax: {
            url: "{{ route('admin.stats.index') }}",
            data: function (d) {
                d.branch_id = $('#branch_id').val();
                d.date_from = $('#date_from').val();
                d.date_to = $('#date_to').val();
            }
        },
        columns: [               
            {data: 'name', name: 'name'},
            {data: 'branch.title', name: 'branch.title'},
            {data: 'report_as_employee_count', name: 'report_as_employee_count',  searchable: false, orderable: true}
        ],
        dom: 'lBfrtip',
        buttons: ['csv', 'print', 'colvis'],
        initComplete: function () {
            $("#go").click(function(){
                table.draw();
                table.one('xhr', function(e, settings, json){
                    console.log(json.params);
                    $('.search_params').text("{{ trans('global.timeFrom') }}: "
                    + (json.params.from ?? " - - - ")
                    + " {{ trans('global.timeTo') }}: "
                    + (json.params.to ?? " - - - ")
                    + " {{ trans('cruds.branch.title_singular') }}: "
                    + (json.params.branch ?? " - - - ")
                    )               
                })
            })
        }
    });
});

</script>
@endsection