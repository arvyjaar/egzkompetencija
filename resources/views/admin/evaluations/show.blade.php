@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.evaluation.title') }}
    </div>

    <div class="card-body">
        <div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Stebėjimo ataskaita
                        </th>
                        <td>
                            @foreach($evaluation->monitoringreports as $id => $monitoringreport)
                                <span class="label label-info label-many">{{ $monitoringreport->exam_date }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Stebėjimo aspektas
                        </th>
                        <td>
                            @foreach($evaluation->criterias as $id => $criteria)
                                <span class="label label-info label-many">{{ $criteria->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Įvertinimas
                        </th>
                        <td>
                            @foreach($evaluation->points as $id => $point)
                                <span class="label label-info label-many">{{ $point->description }}</span>
                            @endforeach
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