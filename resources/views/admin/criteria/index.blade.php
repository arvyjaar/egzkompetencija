@extends('layouts.admin')
@section('content')
@can('create', \App\Models\Criterion::class)
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.criteria.create") }}">
            <i class="far fa-plus-square">&nbsp;</i> {{ trans('cruds.criterion.title_singular')}}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.criterion.title') }} - {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.criterion.title_singular') }}
                        </th>
                        <th>
                            {{ trans('cruds.competency.title_singular') }}
                        </th>
                        <th>
                            {{ trans('cruds.criterion.fields.rating_type') }}
                        </th>
                        <th>
                            {{ trans('global.actions') }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($criteria as $key => $criterion)
                    <tr data-entry-id="{{ $criterion->id }}">
                        <td>
                            {{ $criterion->title ?? '' }}
                        </td>
                        <td>
                            {{ $criterion->competency->title ?? '' }}
                        </td>
                        <td>
                            {{ $criterion->assessment->title ?? '' }}
                        </td>
                        <td>
                            @can('view', $criterion)
                            <a class="btn btn-sm btn-primary" href="{{ route('admin.criteria.show', $criterion->id) }}">
                                <i class="far fa-eye"></i>
                            </a>
                            @endcan
                            @can('update', $criterion)
                            <a class="btn btn-sm btn-info" href="{{ route('admin.criteria.edit', $criterion->id) }}">
                                <i class="far fa-edit"></i>
                            </a>

                            <form action="{{ route('admin.criteria.destroy', $criterion->id) }}" method="POST"
                                onsubmit="return confirm('Ar tikrai trinti?');" style="display: inline-block;">
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
    $('.datatable').DataTable({
        pageLength: 25,
    });
})
</script>
@endsection