@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.competency.title_singular') }}
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
                            {{ $competency->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.worktype.title_singular') }}
                        </th>
                        <td>
                            {{ $competency->worktype->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.criterion.title') }}
                        </th>    
                        <td>
                            @if ($competency->criterion->count() > 0)
                                @foreach ($competency->criterion as $criterion)
                                    <p>{{ $criterion->title }}, {{ $criterion->assessment->title }}</p>
                                @endforeach
                            @else                 
                                <p class="text-danger">{{ trans('global.no') }}</p>
                            @endif    
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                Atgal į sąrašą
            </a>
        </div>
    </div>
</div>
@endsection