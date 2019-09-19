@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.criterion.title') }}
    </div>

    <div class="card-body">
        <div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.criterion.fields.title') }}
                        </th>
                        <td>
                            {{ $criterion->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.criterion.fields.category') }}
                        </th>
                        <td>
                            {{ $criterion->critcategory->title }}
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