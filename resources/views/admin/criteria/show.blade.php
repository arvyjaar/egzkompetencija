@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Darbo aspektas
    </div>

    <div class="card-body">
        <div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            Pavadinimas
                        </th>
                        <td>
                            {{ $criterion->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Kompetencija
                        </th>
                        <td>
                            {{ $criterion->competency->title }}
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