@extends('backend.layouts.default')

@section('title', 'Dashboard V1')

@push('css')
@endpush

@section('content')

<h1 class="page-header">{{ $title }}<small>{{ $subtitle }}</small>&nbsp;<a href="{{ route('geojson.edit',$geojsonData['category_id']) }}" class="btn btn-warning btn-icon btn-circle btn-md"><i class="fa fa-edit "></i></a></h1>

@if ($message = Session::get('success'))

<div class="alert alert-green fade show m-b-10">
    <span class="close" data-dismiss="alert">×</span>
    <b>Success !</b> {{ $message }}
</div>
@endif


<div class="panel panel-inverse" data-sortable-id="table-basic-1">
    <!-- begin panel-heading -->
    <div class="panel-heading bg-green">
        <h4 class="panel-title">Detail Data</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <!-- end panel-heading -->
    <!-- begin panel-body -->
    <div class="panel-body mb-2">
        <div class="title mb-2">

        </div>
        <div class="row">
            <div class="col-xl-6 ui-sortable">

                <div class="table-responsive ">
                    <table class="table table-striped m-b-0 no-border">
                        <tbody>
                            <tr>
                                <td><strong>Nama</strong></td>
                                <td> {{ $geojsonData['category_name']}}</td>
                            </tr>
                            <tr>
                                <td><strong>Tampil</strong></td>
                                <td> {{ $geojsonData['display']?'Ya' : 'Tidak'}}</td>
                            </tr>
                            <tr>
                                <td><strong>Fill Color</strong></td>
                                <td> <button type="button" class="btn " style="background-color: {{ $geojsonData['fill_color']}};color: #ffffff">{{ $geojsonData['fill_color']}}</button></td>
                            </tr>
                            <tr>
                                <td><strong>Opacity</strong></td>
                                <td> {{ $geojsonData['fill_opacity']}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xl-6 ui-sortable">
                <div class="table-responsive ">
                    <table class="table table-striped m-b-0 no-border">
                        <tbody>
                            <tr>
                                <td><strong>Created </strong></td>
                                <td> {{ $geojsonData['created_at']}}</td>
                            </tr>
                            <tr>
                                <td><strong>Updated </strong></td>
                                <td> {{ $geojsonData['updated_at']}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- end panel-body -->
</div>

<div class="panel panel-inverse" data-sortable-id="ui-general-2">
    <!-- begin panel-heading -->
    <div class="panel-heading bg-green ui-sortable-handle">
        <h4 class="panel-title">List Data Geojson</h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <!-- end panel-heading -->
    <!-- begin panel-body -->
    <div class="panel-body" style="">
    <div class="table-responsive ">
            <table class="table table-striped m-b-0 no-border">
                <thead>
                    <tr>
                        <th>#</th>
                        @foreach($propKey as $kh => $vh)
                        <th>{{ $vh['table_key']}}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($geojsonItemData as $kb => $vb)
                    <tr>
                        <td>{{ $vb['data_type'] }}</td>
                        @foreach($vb['data_properties'] as $kb => $vb)
                        <td>{{ $vb}}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- end panel-body -->
    
</div>

@endsection

@push('scripts')

<script>
    $('.btnDelete').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');

        $('#formDelete').attr('action', '<?php echo route('geojson.destroy', '') ?>/' + id)
        $('#deleteName').html(name);
        $('#deleteModal').modal('show')
    })
</script>
@endpush
