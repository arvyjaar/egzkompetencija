@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            Stebėjimo ataskaita Nr. {{ $monitoringReport->id }}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <p><b>Stebėtojas: </b> {{ $monitoringReport->observer->name ?? '' }}</p>
                    <p><b>Stebėjo: </b> {{ $monitoringReport->observing_date }}</p>
                    <p><b>Tipas: </b>{{ App\MonitoringReport::OBSERVING_TYPE_RADIO[$monitoringReport->observing_type] }}
                    </p>
                </div>
                <div class="col-6">
                    <p><b>Egzaminuotojas: </b> {{ $monitoringReport->examiner->name ?? '' }}</p>
                    <p><b>Egzaminavo: </b> {{ substr($monitoringReport->exam_date, 0, 16) }}</p>
                    <p><b>Kategorija: </b>{{ $monitoringReport->drivecategory }}</p>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <label>Vertinimas:</label>
                    <p>
                        @foreach($points as $point)
                            {{ $point->value == 0 ? 'N' : $point->value }} - {{ $point->title }};
                        @endforeach
                    </p>
                    <hr>
                </div>
            </div>
            @foreach($competencies as $competency)

                <div class="row">
                    <div class="col-12">
                        <b>{{ $competency->category->title }}</b>
                    </div>
                </div>
                @foreach($competency->evaluation as $evaluation)
                    <div class="row">
                        <div class="col-8">
                            {{ $evaluation->criterion->title }}</div>
                        <div class="col-4">{{ $evaluation->point->value == 0 ? 'N' : $evaluation->point->value }}</div>
                    </div>
                @endforeach
                <hr>
            @endforeach

            <table class="table table-bordered table-striped">
                <tbody>


                @if(isset($monitoringReport->technical_notes))
                    <tr>
                        <th>
                            Papildomos/bendrosios pastabos (pastabos dėl techninių priemonių, trukdančių efektyviam
                            darbui, nesusijusios su šiuo įvertinimu)
                        </th>
                        <td>
                            {{ $monitoringReport->technical_note }}
                        </td>
                    </tr>
                @endif
                <tr>
                    <th>
                        Stebėtojo išvados, pasiūlymai
                    </th>
                    <td>
                        {!! $monitoringReport->observer_note !!}
                    </td>
                </tr>
                <tr>
                    <th>
                        Egzaminuotojo atsiliepimas
                    </th>
                    <td>
                        {!! $monitoringReport->examiner_note !!}
                    </td>
                </tr>
                <tr>
                    <th>
                        Egzaminuotojas susipažino
                    </th>
                    <td>
                        {{ $monitoringReport->examiner_reviewed }}
                    </td>
                </tr>
                <tr>
                    <th>
                        Egzaminavimo ir vairuotojo pažymėjimų išdavimo skyriaus pastabos
                    </th>
                    <td>
                        {!! $monitoringReport->evpis_notes !!}
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