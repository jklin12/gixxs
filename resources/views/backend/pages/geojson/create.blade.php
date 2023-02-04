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
        <form action="{{ route('geojson.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Menu</label>
                <div class="col-md-9">
                    <select class="form-control" name="menu" id="select-menu">
                        <option value=""></option>
                        @foreach($menu as $key => $value)
                        <option value="{{$value->menu_id}}">{{$value->menu_name}}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Category</label>
                <div class="col-md-9">
                    <select class="form-control" name="category" id="select-category">
                        <option value=""></option>

                    </select>

                </div>
            </div>

            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Nama</label>
                <div class="col-md-9">
                    <input type="texxt" class="form-control m-b-5" placeholder="Masukan Nama" name="name" value="{{ old('Name') }}">
                </div>
            </div>

            <div class="form-group row m-b-15">
                <label for="recipient-name" class="col-form-label col-md-3">Color :</label>
                <div class="col-md-9">
                    <div class="input-group">
                        <input class="form-control" name="geojson_color" id="add-category-color" data-id="color-palette-1" />
                        <div class="input-group-append">
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <div id="color-palette-1"></div>
                                </li>
                            </ul>
                            <a href="#" class="btn btn-grey text-black-lighter" data-toggle="dropdown"><i class="fa fa-tint fa-lg"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label for="recipient-name" class="col-form-label col-md-3">Opacity :</label>
                <div class="col-md-9">
                    <input type="number" step="any" class="form-control" id="add-opacity" name="geojson_opacity">
                </div>

            </div>

            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">File</label>
                <div class="col-md-9">
                    <input type="file" class="form-control m-b-5" name="file">
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

        $('#select-menu').change(function() {
            var selected = $(this).val();

            $.get('/api/category/' + selected,
                function(data) {
                    var model = $('#select-category');
                    model.empty();
                    model.append("<option>Select a state</option>");
                    $.each(data.data, function(index, element) {
                        model.append("<option value='" + element.category_id + "'>" + element.category_name + "</option>");
                    });
                }
            );
        })
    });
</script>

@endpush