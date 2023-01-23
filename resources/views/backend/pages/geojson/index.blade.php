@extends('backend.layouts.default')

@section('title', 'Dashboard V1')

@push('css')
@endpush

@section('content')

<h1 class="page-header">{{ $title }}<small>{{ $subtitle }}</small></h1>

<div class="mb-2">
    <a href="{{ route('geojson.create') }}" class="btn btn-primary"><i class="fa fa-add"></i> Tambah Data</a>
</div>
@if ($message = Session::get('success'))

<div class="alert alert-green fade show m-b-10">
    <span class="close" data-dismiss="alert">×</span>
    <b>Success !</b> {{ $message }}
</div>
@endif


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
        <!-- begin table-responsive -->
        <div class="table-responsive table-striped mb-2">
            <table class="table m-b-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-center">Name</th> 
                        <th class="text-center">Tampil</th> 
                        <th class="text-center">Color</th>
                        <th class="text-center">Opacity</th>
                        <th colspan="3" class="text-center">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $value)
                    <tr>
                        <td>{{ $loop->iteration + $data->firstItem() - 1 }}</td>
                        <td>{{ $value->category_name}}</td> 
                        <td>{{ $value->display == 1 ? 'Ya' :'Tidak'}}</td> 
                        <td><button type="button" class="btn " style="background-color: {{ $value->fill_color}};color: #ffffff">{{ $value->fill_color}}</button></td> 
                        <td>{{ $value->fill_opacity}}</td> 
                        <td><a href="{{ route('geojson.show',$value->category_id) }}"  class="btn btn-primary btn-icon btn-circle btn-md"><i class="fa fa-search-plus "></i></a></td>
                        <td><a href="{{ route('geojson.edit',$value->category_id) }}"  class="btn btn-warning btn-icon btn-circle btn-md"><i class="fa fa-edit "></i></a></td>
                        <td><a href="javascript:;"   data-id="{{$value->category_id}}" data-name="{{ $value->category_name}}" class="btn btn-danger btn-icon btn-circle btn-md btnDelete"><i class="fa fa-trash "></i></a></td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- end table-responsive -->
        {{ $data->links() }}
    </div>
    <!-- end panel-body -->

</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  method="post" id="formDelete">
                    @csrf
                    @method('DELETE')
                    Apakah anda yakin menghapus <strong id="deleteName"></strong>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" form="formDelete" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

<script>
    $('.btnDelete').click(function(){
        var id = $(this).data('id');
        var name = $(this).data('name');

        $('#formDelete').attr('action','<?php echo route('geojson.destroy','') ?>/'+id)
        $('#deleteName').html(name);
        $('#deleteModal').modal('show')
    })
</script>
@endpush