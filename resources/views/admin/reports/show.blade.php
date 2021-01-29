@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.report.title_singular')}} Nr. {{ $report->id }}
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-2">
                <p><b>{{ trans('cruds.report.fields.observer') }}</b> {{ $report->observer->name ?? '' }}</p>
                <p><b>{{ trans('cruds.report.fields.observing_date') }}</b> {{ $report->observing_date }}</p>
                <p><b>{{ trans('cruds.report.fields.observing_type') }}</b> {{ $report->observingType->title}}
                </p>
            </div>
            <div class="col-3">
                <p><b>{{ trans('cruds.report.fields.employee') }}</b> {{ $report->employee->name ?? '' }}</p>
                <p><b>{{ trans('cruds.report.fields.procedure_datetime') }}</b> {{ substr($report->procedure_date, 0, 16) }}</p>
                @if ($report->drivecategory)
                <p><b>{{ trans('cruds.report.fields.category') }} </b>{{ $report->drivecategory->title ?? '' }}</p>
                @endif
            </div>
            <div class="col-2">
                <p><b>{{ trans('cruds.form.title_singular') }}</b> {{ $report->form->title ?? '' }}, v.{{ $report->form->version }}</p>
                <p><b>{{ trans('cruds.worktype.title_singular') }}</b> {{ $report->form->worktype->title ?? '' }}</p>
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
                {{ $evaluation->criterionWithTrashed->title }}
            </div>
            <div class="col-2">
                {{ $evaluation->assessment->title }}
            </div>
            <div class="col-1">
                <div @if(in_array($evaluation->assessment_value, $evaluation->criterionWithTrashed->assessment->bad_values))
                        class="text-center square text-danger"
                    @elseif (strtolower($evaluation->assessment_value) == 'n')
                        class="text-center square text-warning"
                    @else
                        class="text-center square"
                    @endif
                >
                    <b title="{{ $evaluation->criterionWithTrashed->assessment->title }}">{{ strtoupper($evaluation->assessment_value) }}</b>
                </div>
            </div>
        </div>
        @endforeach
        <div class="row">
            <div class="col-8">
                <br>
                @isset($evaluations->competency_note)
                <p><u><i>{{ trans('cruds.report.fields.notes_singular') }}:</i></u> <span class="text-info">{{ $evaluations->competency_note }}</span></p>
                @endisset
                <hr>
            </div>
        </div>
        @endforeach

        <div class="row">
            <div class="col-8">
                <b>{{ trans('cruds.report.fields.technical_notes') }}</b>
                <p><span class="text-info">{{ $report->technical_note ?? '-' }}</span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <b>{{ trans('cruds.report.fields.observer_notes') }}</b>
                <p><span class="text-info">{{ $report->observer_note ?? '-' }}</span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <b>{{ trans('cruds.report.fields.employee_notes') }}</b>
                <p><span class="text-info">{{ $report->employee_note ?? '-'}}</span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <b>{{ trans('cruds.report.fields.employee_reviewed_at') }}</b>
                @isset($report->employee_reviewed_at)
                <p><span class="text-info">{{ $report->employee_reviewed_at }}</span></p>
                @endisset
                @empty($report->employee_reviewed_at)
                <p class="text-danger">{{ trans('cruds.report.not_reviewed') }}</p>
                @endempty
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <b>{{ trans('cruds.report.fields.manager_notes') }}</b>
                <p><span class="text-info">{{ $report->manager_note ?? '-' }}</span></p>
            </div>
        </div>
        <div class="row">
            <div class="col-2">
                <a class="btn btn-default" href="{{ route('admin.reports.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>

            @can('report_comment', $report)
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#commentModal">
                {{ trans('global.write_note') }}
            </button>

            <!-- Modal -->
            <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="commentModalLabel">
                                @if(auth()->user()->id === $report->employee_id)
                                {{ trans('cruds.report.fields.employee_notes') }}
                                @else
                                {{ trans('cruds.report.fields.manager_notes') }}
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
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('global.close') }}
                                </button>
                                <button type="submit" class="btn btn-danger">{{ trans('global.save') }}</button>
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