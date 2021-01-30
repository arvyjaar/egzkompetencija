@extends('layouts.admin')
@section('content')
@can('create', \App\Models\Competency::class)
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.competencies.create") }}">
            <i class="far fa-plus-square">&nbsp;</i> {{ trans('cruds.competency.title_singular')}}
        </a>
    </div>
</div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.competency.title') }} - {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th>
                            {{ trans('cruds.competency.title_singular') }}
                        </th>
                        <th>
                            {{ trans('cruds.worktype.title_singular') }}
                        </th>
                        <th>
                            {{ trans('cruds.criterion.title') }}
                        </th>
                        <th>
                            {{ trans('global.actions') }}
                        </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($competencies as $competency)
                    <tr data-entry-id="{{ $competency->id }}">
                        <td>
                            {{ $competency->title ?? '' }}
                        </td>
                        <td>
                            {{ $competency->worktype->title ?? '' }}
                        </td>
                        <td>
                            @if ($competency->criterion->count() > 0)
                                {{ $competency->criterion->count() }}
                            @else     
                                <span class="text-danger">{{ trans('global.no') }}</span>
                            @endif
                        </td>  
                        <td>
                            @can('view', $competency)
                            <a class="btn btn-sm btn-primary"
                                href="{{ route('admin.competencies.show', $competency->id) }}">
                                <i class="far fa-eye"></i>
                            </a>
                            @endcan
                            @can('update', $competency)
                            <a class="btn btn-sm btn-info"
                                href="{{ route('admin.competencies.edit', $competency->id) }}">
                                <i class="far fa-edit"></i>
                            </a>

                            <form action="{{ route('admin.competencies.destroy', $competency->id) }}" method="POST"
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