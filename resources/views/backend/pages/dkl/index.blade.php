@extends('backend.layouts.default')

@section('title', 'Dashboard V1')

@push('css')
@endpush

@section('content')

<h1 class="page-header">{{ $title }}<small>{{ $subtitle }}</small></h1>

<div class="mb-2">
    <a href="{{ route('dkl.create') }}" class="btn btn-green btn-sm"><i class="fa fa-plus  mr-1 "></i>Tambah Data</a>
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
                        <th class="text-center">Nama</th>
                        <th class="text-center">Tanggal Expired</th>
                        <th class="text-center">File</th>
                        <th colspan="2" class="text-center">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $value)
                    <tr>
                        <td>{{ $loop->iteration + $data->firstItem() - 1 }}</td>
                        <td>{{ $value->dkl_nama}}</td> 
                        <td>{{ $value->dkl_exp_date }}</td> 
                        <td><a href="/storage/{{ $value->dkl_file}}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-cloud-download-alt mr-1"></i>Download</a></td>
                        <td><a href="{{ route('dkl.edit',$value->dkl_id) }}"  class="btn btn-warning btn-sm"><i class="fa fa-edit mr-1"></i>Edit</a></td>
                        <td><a href="javascript:;"   data-id="{{$value->dkl_id}}" data-name="{{ $value->dkl_nama}}" class="btn btn-danger btn-sm btnDelete"><i class="fa fa-trash mr-1"></i>Hapus</a></td>

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

        $('#formDelete').attr('action','<?php echo route('dkl.destroy','') ?>/'+id)
        $('#deleteName').html(name);
        $('#deleteModal').modal('show')
    })
</script>
@endpush
