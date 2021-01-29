@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.criterion.title_singular') }}
    </div>

    <div class="card-body">
        <div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('global.title') }}
                        </th>
                        <td>
                            {{ $criterion->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competency.title') }}
                        </th>
                        <td>
                            {{ $criterion->competency->title }} ({{ $criterion->competency->worktype->title }})
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.assessment_type.title_singular') }}
                        </th>
                        <td>
                            {{ $criterion->assessment->title }}
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