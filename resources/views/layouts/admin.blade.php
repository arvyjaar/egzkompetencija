<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8" />
		<meta name="viewport"
			content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<meta name="csrf-token" content="{{ csrf_token() }}" />

		<title>{{ trans('panel.site_title') }}</title>
		<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" />
		<link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" />
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" rel="stylesheet" />
		<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet" />
		<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
		<link href="https://cdn.datatables.net/select/1.3.0/css/select.dataTables.min.css" rel="stylesheet" />
		<link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet" />
		<link
			href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
			rel="stylesheet" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css"
			rel="stylesheet" />
		<link href="{{ asset('css/adminltev3.css') }}" rel="stylesheet" />
		<link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
		@yield('styles')
	</head>

	<body class="sidebar-mini layout-fixed" style="height: auto">
		<div class="wrapper">
			<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
				<!-- Left navbar links -->
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
					</li>
				</ul>

				<!-- Right navbar links -->
				<span>{{ trans('global.logged_in') }}: <i>{{ auth()->user()->name }}</i></span>
			</nav>

			@include('partials.menu')
			<div class="content-wrapper" style="min-height: 917px">
				<!-- Main content -->
				<section class="content" style="padding-top: 20px">
					@if(session('message'))
					<div class="row mb-2">
						<div class="col-lg-12">
							<div class="alert alert-success" role="alert">
								{{ session('message') }}
							</div>
						</div>
					</div>
					@endif @if($errors->count() > 0)
					<div class="alert alert-danger">
						<ul class="list-unstyled">
							@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif @yield('content')
				</section>
				<!-- /.content -->
			</div>

			<footer class="main-footer">
				<div class="float-right d-none d-sm-block"><b>Versija</b> 0.1-alpha</div>
				<strong> &copy;</strong>
				<a href="https://jaar.lt" target="_blank">JAAR</a>
			</footer>

			<form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none">
				{{ csrf_field() }}
			</form>
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<script src="https://unpkg.com/@popperjs/core@2"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
		<script src="https://cdn.datatables.net/select/1.3.0/js/dataTables.select.min.js"></script>
		<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
		<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
		<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"
			integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ=="
			crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

		{{-- @include('partials.quickadmin-datatables') --}}

		@yield('scripts')

		@include('partials.adminlte-theme-scripts')

		@include('partials.main-javascripts')

	</body>

</html>