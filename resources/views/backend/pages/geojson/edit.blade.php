@extends('backend.layouts.default')

@section('title', 'Dashboard V1')

@push('css')
<link href="/assets/backend/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
@endpush

@section('content')

<h1 class="page-header">{{ $title }}<small>{{ $subtitle }}</small></h1>


<div class="panel panel-inverse" data-sortable-id="table-basic-1">
    <!-- begin panel-heading -->
    <div class="panel-heading bg-green">
        <h4 class="panel-title"></h4>
        <div class="panel-heading-btn">
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
            <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
    </div>
    <!-- end panel-heading -->
    <!-- begin panel-body -->
    <div class="panel-body">
        @if($errors->any())
        @foreach($errors->all() as $err)
        <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
        @endif
        <form action="{{ route('geojson.update',$data->category_id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Nama</label>
                <div class="col-md-9">
                    <input type="texxt" class="form-control m-b-5" placeholder="Masukan Nama" name="name" value="{{ $data->category_name }}">
                </div>
            </div>

            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Tampil</label>
                <div class="col-md-9">
                    <select class="form-control" name="display">
                        <option value="1" {{ $data->display ? 'selected': ''}}>Ya</option>
                        <option value="0" {{ !$data->display ? 'selected': ''}}>Tidak</option>
                    </select>
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Color</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <input class="form-control" name="fill_color" data-id="color-palette-1" value="{{ $data->fill_color }}"/>
                        <div class="input-group-append">
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <div id="color-palette-1"></div>
                                </li>
                            </ul>
                            <a href="#" class="btn btn-primary text-white" data-toggle="dropdown"><i class="fa fa-tint fa-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Opacity</label>
                <div class="col-md-9">
                    <input type="texxt" class="form-control m-b-5" placeholder="" name="fill_opacity" value="{{ $data->fill_opacity }}">
                </div>
            </div>



            <button type="submit" class="btn btn-primary m-r-5 m-b-5">Simpan</button>
        </form>

    </div>
    <!-- end panel-body -->

</div>
@endsection

@push('scripts')
<script src="/assets/backend/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
<script>
    $(document).ready(function() {
        $('#color-palette-1').colorPalette().on('selectColor', function(e) {
            $('[data-id="color-palette-1"]').val(e.color);
        });
    });
</script>

@endpush