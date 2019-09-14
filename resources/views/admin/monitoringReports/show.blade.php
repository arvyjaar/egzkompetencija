@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.monitoringReport.title') }}
    </div>

    <div class="card-body">
        <div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoringReport.fields.observer') }}
                        </th>
                        <td>
                            {{ $monitoringReport->observer }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoringReport.fields.user') }}
                        </th>
                        <td>
                            {{ $monitoringReport->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoringReport.fields.branch') }}
                        </th>
                        <td>
                            {{ $monitoringReport->branch }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoringReport.fields.exam_date') }}
                        </th>
                        <td>
                            {{ $monitoringReport->exam_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoringReport.fields.category') }}
                        </th>
                        <td>
                            {{ $monitoringReport->category }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoringReport.fields.observing_date') }}
                        </th>
                        <td>
                            {{ $monitoringReport->observing_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoringReport.fields.observing_type') }}
                        </th>
                        <td>
                            {{ App\MonitoringReport::OBSERVING_TYPE_RADIO[$monitoringReport->observing_type] }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoringReport.fields.technical_notes') }}
                        </th>
                        <td>
                            {!! $monitoringReport->technical_notes !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoringReport.fields.observer_notes') }}
                        </th>
                        <td>
                            {!! $monitoringReport->observer_notes !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoringReport.fields.examiner_notes') }}
                        </th>
                        <td>
                            {!! $monitoringReport->examiner_notes !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoringReport.fields.examiner_reviewed') }}
                        </th>
                        <td>
                            {{ $monitoringReport->examiner_reviewed }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.monitoringReport.fields.evpis_notes') }}
                        </th>
                        <td>
                            {!! $monitoringReport->evpis_notes !!}
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