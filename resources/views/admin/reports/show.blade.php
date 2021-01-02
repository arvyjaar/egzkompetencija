@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Stebėjimo ataskaita Nr. {{ $report->id }}
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-2">
                <p><b>Stebėtojas: </b> {{ $report->observer->name ?? '' }}</p>
                <p><b>Stebėjo: </b> {{ $report->observing_date }}</p>
                <p><b>Tipas: </b>{{ $report->observingType->title}}
                </p>
            </div>
            <div class="col-3">
                <p><b>Darbuotojas: </b> {{ $report->employee->name ?? '' }}</p>
                <p><b>Procedūros data: </b> {{ substr($report->procedure_date, 0, 16) }}</p>
                <p><b>Kategorija: </b>{{ $report->drivecategory->title ?? '' }}</p>
            </div>
            <div class="col-2">
                <p><b>Forma: </b> {{ $report->form->title ?? '' }}, v.{{ $report->form->version }}</p>
                <p><b>Veikla: </b> {{ $report->form->worktype->title ?? '' }}</p>
            </div>
        </div>
        <hr>

        @foreach($evaluation_set as $competency_title => $evaluations)

        <div class="row">
            <div class="col-12">
                <b>{{ $competency_title }}</b>
            </div>
        </div>
        @foreach($evaluations as $evaluation)
        <div class="row">
            <div class="col-9">
                {{ $evaluation->criterion->title }}
            </div>
            <div class="col-2">
                {{ $evaluation->assessment->title }}
            </div>
            <div class="col-1">
                <span @if(in_array($evaluation->assessment_value, $evaluation->criterion->assessment->bad_values))
                        class="text-center square text-danger"
                    @elseif (strtolower($evaluation->assessment_value) == 'n')
                        class="text-center square text-warning"
                    @else
                        class="text-center square"
                    @endif
                >
                    <b title="{{ $evaluation->criterion->assessment->title }}">{{ strtoupper($evaluation->assessment_value) }}</b>
                </span>
            </div>
        </div>
        @endforeach
        <div class="row">
            <div class="col-8">
                <br>
                @if(isset($evaluations->competency_note))
                <p><u><i>Pastaba:</i></u> <span class="text-info">{{ $evaluations->competency_note }}</span></p>
                @endif
                <hr>
            </div>
        </div>

        @endforeach

        <div class="row">
            <div class="col-8">
                <b>Papildomos/bendrosios pastabos (pastabos dėl techninių priemonių, trukdančių efektyviam
                    darbui, nesusijusios su šiuo įvertinimu)</b>
                <p><span class="text-info">{{ $report->technical_note ?? 'nėra' }}</span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <b>Stebėtojo išvados, pasiūlymai</b>
                <p><span class="text-info">{{ $report->observer_note ?? 'nėra' }}</span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <b>Darbuotojo atsiliepimas</b>
                <p><span class="text-info">{{ $report->employee_note ?? 'nėra'}}</span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <b>Darbuotojas susipažino</b>
                @if(isset($report->employee_reviewed_at))
                <p><span class="text-info">{{ $report->employee_reviewed_at }}</span></p>
                @else
                <p class="text-danger">nesusipažino</p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <b>Administracijos pastabos</b>
                <p><span class="text-info">{{ $report->manager_note ?? 'nėra' }}</span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <a class="btn btn-default" href="{{ url()->previous() }}">
                    Atgal į sąrašą
                </a>
            </div>

            @can('report_comment', $report)
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#commentModal">
                Rašyti pastabą
            </button>

            <!-- Modal -->
            <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="commentModalLabel">
                                @if(auth()->user()->id === $report->employee_id)
                                Darbuotojo pastaba
                                @else
                                Administracijos pastaba
                                @endif
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route("admin.reports.comment", [$report->id]) }}" method="POST"
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