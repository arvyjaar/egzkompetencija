@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row justify-content-md-center">
        <div class="col-md-4">
            @foreach ($forms as $form)
            <a class="btn btn-outline-dark form-type" href="{{ route('admin.reports.create-report', ['id' => $form->id]) }}">
                <h4>{{ $form->title.', vers. '.$form->version.' - '.$form->worktype->title }}</h4>
                <p>{{ trans('cruds.report.title') }}: {{ $form->report->count() }}</p>
            </a>
            <p></p>
            @endforeach
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent

@endsection