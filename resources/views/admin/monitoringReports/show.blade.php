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
            @foreach($results as $result)

                <div class="row">
                    <div class="col-12">
                        <b>{{ $result->competency->title }}</b>
                    </div>
                </div>
                @foreach($result->evaluations as $evaluation)
                    <div class="row">
                        <div class="col-8">
                            {{ $evaluation->criterion->title }}</div>
                        <div class="col-4">{{ $evaluation->point->value == 0 ? 'N' : $evaluation->point->value }}</div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-12">
                        <br>
                        @if(isset($result->competency_note))
                            <p><u><i>Pastaba:</i></u> <span
                                        class="text-info">{{ $result->competency_note->text }}</span></p>
                        @endif
                    </div>
                </div>
                <hr>
            @endforeach

            <div class="row">
                <div class="col-12">
                    <b>Papildomos/bendrosios pastabos (pastabos dėl techninių priemonių, trukdančių efektyviam
                        darbui, nesusijusios su šiuo įvertinimu)</b>
                    <p><span class="text-info">{{ $monitoringReport->technical_note ?? 'nėra' }}</span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <b>Stebėtojo išvados, pasiūlymai</b>
                    <p><span class="text-info">{{ $monitoringReport->observer_note ?? 'nėra' }}</span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <b>Egzaminuotojo atsiliepimas</b>
                    <p><span class="text-info">{{ $monitoringReport->examiner_note ?? 'nėra'}}</span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <b>Egzaminuotojas susipažino</b>
                    @if(isset($monitoringReport->examiner_reviewed))
                        <p><span class="text-info">{{ $monitoringReport->examiner_reviewed }}</span></p>
                    @else
                        <p class="text-danger">nesusipažino</p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <b>Egzaminavimo ir vairuotojo pažymėjimų išdavimo skyriaus pastabos</b>
                    <p><span class="text-info">{{ $monitoringReport->evpis_notes ?? 'nėra' }}</span></p>
                </div>
            </div>

            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                Atgal į sąrašą
            </a>
        </div>
    </div>

@endsection