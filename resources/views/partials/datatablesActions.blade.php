@can($viewGate, $row)
    <a class="btn btn-sm btn-primary" href="{{ route('admin.' . $crudRoutePart . '.show', $row->id) }}">
        <i class="far fa-eye"></i>
    </a>
@endcan
@can($editGate, $row)
    <a class="btn btn-sm btn-info" href="{{ route('admin.' . $crudRoutePart . '.edit', $row->id) }}">
        <i class="far fa-edit"></i>
    </a>
@endcan
@can($deleteGate, $row)
    <form action="{{ route('admin.' . $crudRoutePart . '.destroy', $row->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" class="btn btn-sm btn-danger"><i class="far fa-trash-alt"></i></button>
    </form>
@endcan