@extends('backend.layouts.default')

@section('title', 'Dashboard V1')

@push('css')
<link href="/assets/backend/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
<link href="/assets/backend/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
<link href="/assets/backend/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
	<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
	<li class="breadcrumb-item active">Dashboard</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Dashboard <small></small></h1>
<!-- end page-header -->

<!-- begin row -->
<div class="row">
	<!-- begin col-3 -->
	<div class="col-xl-3 col-md-6">
		<div class="widget widget-stats bg-blue">
			<div class="stats-icon"><i class="fa fa-tree"></i></div>
			<div class="stats-info">
				<h4>Jumlah Ijin Lingkungan</h4>
				<p>{{$il}}</p>
			</div>
			<div class="stats-link">
				<a href="{{ route('ijin_lingkungan.index') }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-xl-3 col-md-6">
		<div class="widget widget-stats bg-info">
			<div class="stats-icon"><i class="fa fa-database"></i></div>
			<div class="stats-info">
				<h4>Jumlah Kawasan Ekosistem Esensial</h4>
				<p>{{ $kes }}</p>
			</div>
			<div class="stats-link">
				<a href="{{ route('kes.index') }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-xl-3 col-md-6">
		<div class="widget widget-stats bg-orange">
			<div class="stats-icon"><i class="fa fa-file-archive"></i></div>
			<div class="stats-info">
				<h4>Jumlah Dokumen Kajian Lingkungan</h4>
				<p>{{ $dkl }}</p>
			</div>
			<div class="stats-link">
				<a href="{{ route('dkl.index') }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-xl-3 col-md-6">
		<div class="widget widget-stats bg-red">
			<div class="stats-icon"><i class="fa fa-file"></i></div>
			<div class="stats-info">
				<h4>SPPL</h4>
				<p>{{ $sppl}}</p>
			</div>
			<div class="stats-link">
				<a href="{{ route('sppl.index') }}">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
			</div>
		</div>
	</div>
	<!-- end col-3 -->
</div>
<!-- end row -->
 
@endsection

@push('scripts')
<script src="/assets/backend/plugins/gritter/js/jquery.gritter.js"></script>
<script src="/assets/backend/plugins/flot/source/jquery.canvaswrapper.js"></script>
<script src="/assets/backend/plugins/flot/source/jquery.colorhelpers.js"></script>
<script src="/assets/backend/plugins/flot/source/jquery.flot.js"></script>
<script src="/assets/backend/plugins/flot/source/jquery.flot.saturated.js"></script>
<script src="/assets/backend/plugins/flot/source/jquery.flot.browser.js"></script>
<script src="/assets/backend/plugins/flot/source/jquery.flot.drawSeries.js"></script>
<script src="/assets/backend/plugins/flot/source/jquery.flot.uiConstants.js"></script>
<script src="/assets/backend/plugins/flot/source/jquery.flot.time.js"></script>
<script src="/assets/backend/plugins/flot/source/jquery.flot.resize.js"></script>
<script src="/assets/backend/plugins/flot/source/jquery.flot.pie.js"></script>
<script src="/assets/backend/plugins/flot/source/jquery.flot.crosshair.js"></script>
<script src="/assets/backend/plugins/flot/source/jquery.flot.categories.js"></script>
<script src="/assets/backend/plugins/flot/source/jquery.flot.navigate.js"></script>
<script src="/assets/backend/plugins/flot/source/jquery.flot.touchNavigate.js"></script>
<script src="/assets/backend/plugins/flot/source/jquery.flot.hover.js"></script>
<script src="/assets/backend/plugins/flot/source/jquery.flot.touch.js"></script>
<script src="/assets/backend/plugins/flot/source/jquery.flot.selection.js"></script>
<script src="/assets/backend/plugins/flot/source/jquery.flot.symbol.js"></script>
<script src="/assets/backend/plugins/flot/source/jquery.flot.legend.js"></script>
<script src="/assets/backend/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="/assets/backend/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
<script src="/assets/backend/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
<script src="/assets/backend/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script src="/assets/backend/js/demo/dashboard.js"></script>
@endpush