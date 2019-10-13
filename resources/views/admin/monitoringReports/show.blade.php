@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            Stebėjimo ataskaita Nr. {{ $monitoringReport->id }}
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <p><b>Stebėtojas: </b> {{ $monitoringReport->observer->name ?? '' }}</p>
                    <p><b>Stebėjo: </b> {{ $monitoringReport->observing_date }}</p>
                    <p><b>Tipas: </b>{{ App\MonitoringReport::OBSERVING_TYPE_RADIO[$monitoringReport->observing_type] }}
                    </p>
                </div>
                <div class="col-3">
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
                    <p><span class="text-info">{{ $monitoringReport->evpis_note ?? 'nėra' }}</span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <a style="" class="btn btn-default" href="{{ url()->previous() }}">
                        Atgal į sąrašą
                    </a>
                </div>

            @can('report_comment', $monitoringReport)
                <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                            data-target="#commentModal">
                        Rašyti pastabą
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="commentModal" tabindex="-1" role="dialog"
                         aria-labelledby="commentModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="commentModalLabel">
                                        @if(auth()->user()->id === $monitoringReport->examiner_id)
                                            Egzaminuotojo pastaba
                                        @else
                                            EVPIS pastaba
                                        @endif
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route("admin.monitoring-reports.comment", [$monitoringReport->id]) }}"
                                      method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <textarea name="comment" class="form-control"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Uždaryti
                                        </button>
                                        <button type="submit" class="btn btn-danger">Išsaugoti</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>
        </div>
    </div>

@endsection