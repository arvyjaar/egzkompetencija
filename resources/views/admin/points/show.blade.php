@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.point.title') }}
    </div>

    <div class="card-body">
        <div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.point.fields.description') }}
                        </th>
                        <td>
                            {{ $point->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.point.fields.value') }}
                        </th>
                        <td>
                            {{ $point->value }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>
@endsection