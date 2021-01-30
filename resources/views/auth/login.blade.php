@extends('layouts.app')
@section('content')
<div class="login-box">
    <div class="login-logo">
        <div class="login-logo">
            <a href="#">
                {{ trans('panel.site_title') }}
            </a>
        </div>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Prisijungti</p>
            @if(\Session::has('message'))
                <p class="alert alert-info">
                    {{ \Session::get('message') }}
                </p>
            @endif
            <form action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="el. paštas" name="email">
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <div class="input-group">
                        <input type="password" class="form-control" placeholder="Slaptažodis" name="password">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-flat">Prisijungti</button>
                {{--
                <div class="row">
                    <div class="col-8">
                        <input type="checkbox" name="remember"> Prisiminti mane
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Prisijungti</button>
                    </div>
                    <!-- /.col -->
                </div>
                --}}
            </form>


    {{--
            <p class="mb-1">
                <a class="" href="{{ route('password.request') }}">
                    Pamiršote slaptažodį?
                </a>
            </p>
            <p class="mb-0">

            </p>
            <p class="mb-1">

            </p>
    --}}
        </div>
        <!-- /.login-card-body -->
    </div>
    <!-- test accounts -->
    <div style="color: darkred">
        <u>Test accounts:</u> <br><br>
        admin@example.com - Admin <br>
        manager@example.com - Manager <br>
        observer@example.com - Observer <br>
        employee@example.com - Employee <br><br>
        
        <u>paswords:</u> "password" for all users
    </div>
</div>
@endsection