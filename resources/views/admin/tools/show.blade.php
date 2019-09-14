@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.tool.title') }}
    </div>

    <div class="card-body">
        <div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.tool.fields.title') }}
                        </th>
                        <td>
                            {{ $tool->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tool.fields.model') }}
                        </th>
                        <td>
                            {{ $tool->model }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tool.fields.condition') }}
                        </th>
                        <td>
                            {{ $tool->condition }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tool.fields.note') }}
                        </th>
                        <td>
                            {!! $tool->note !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.tool.fields.branch') }}
                        </th>
                        <td>
                            {{ $tool->branch }}
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