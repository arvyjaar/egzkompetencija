@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.form.title_singular') }}
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
                            {{ $form->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.form.fields.version') }}
                        </th>
                        <td>
                            {{ $form->version }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.worktype.title_singular') }}
                        </th>
                        <td>
                            {{ $form->worktype->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.competency.title') }}
                        </th>
                        <td>                           
                            @foreach ($form->competency as $competency)
                            <p>{{ $competency->title }}, {{ $competency->worktype->title }}</p>
                            @endforeach                                          
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.form.fields.active') }}
                        </th>
                        <td>
                            {{ $form->active ? trans('global.yes') : trans('global.no') }}
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