@extends('backend.layouts.default')

@section('title', 'Dashboard V1')

@push('css')
@endpush

@section('content')

<h1 class="page-header">{{ $title }}<small>{{ $subtitle }}</small></h1>

<div class="mb-2">
    <a href="{{ route('ijin_lingkungan.create') }}" class="btn btn-primary"><i class="fa fa-add"></i> Tambah Data</a>
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
                        <th class="text-center">NIB</th>
                        <th class="text-center">Jenis Usaha</th>
                        <th class="text-center">Penanggung Jawab</th>
                        <th class="text-center">Jabatan</th>
                        <th class="text-center">Alamat Pusat</th>
                        <th class="text-center">Alamat Perwakilan</th>
                        <th class="text-center">Alamat Cabang</th>
                        <th class="text-center">Lokasi Ijin</th>
                        <th class="text-center">File</th>
                        <th colspan="2" class="text-center">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $value)
                    <tr>
                        <td>{{ $loop->iteration + $data->firstItem() - 1 }}</td>
                        <td>{{ $value->il_nama}}</td>
                        <td>{{ $value->il_nib}}</td>
                        <td>{{ $value->il_jenis_usaha}}</td>
                        <td>{{ $value->il_penanggung_jawab}}</td>
                        <td>{{ $value->il_jabatan}}</td>
                        <td>{{ $value->il_alamat_pusat}}</td>
                        <td>{{ $value->il_alamat_perwakilan}}</td>
                        <td>{{ $value->il_alamat_cabang}}</td>
                        <td>{{ $value->il_lokasi}}</td>
                        <td><a href="/storage/{{ $value->il_file}}" target="_blank" class="btn btn-primary btn-icon btn-circle btn-md"><i class="fa fa-cloud-download-alt "></i></a></td>
                        <td><a href="{{ route('ijin_lingkungan.edit',$value->il_id) }}"  class="btn btn-warning btn-icon btn-circle btn-md"><i class="fa fa-edit "></i></a></td>
                        <td><a href="javascript:;"   data-id="{{$value->il_id}}" data-name="{{ $value->il_nama}}" class="btn btn-danger btn-icon btn-circle btn-md btnDelete"><i class="fa fa-trash "></i></a></td>

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

        $('#formDelete').attr('action','<?php echo route('ijin_lingkungan.destroy','') ?>/'+id)
        $('#deleteName').html(name);
        $('#deleteModal').modal('show')
    })
</script>
@endpush