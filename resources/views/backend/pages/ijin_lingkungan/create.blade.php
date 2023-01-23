@extends('backend.layouts.default')

@section('title', 'Dashboard V1')

@push('css')
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
        <form action="{{ route('ijin_lingkungan.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Nama</label>
                <div class="col-md-9">
                    <input type="texxt" class="form-control m-b-5" placeholder="Masukan Nama" name="nama" value="{{ old('nama') }}">
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">NIB</label>
                <div class="col-md-9">
                    <input type="texxt" class="form-control m-b-5" placeholder="Masukan NIB" name="nib" value="{{ old('nib') }}">
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Jenis Usaha</label>
                <div class="col-md-9">
                    <input type="texxt" class="form-control m-b-5" placeholder="Masukan Jenis Usaha" name="jenis_usaha" value="{{ old('jenis_usaha') }}">
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Penanggung Jawab</label>
                <div class="col-md-9">
                    <input type="texxt" class="form-control m-b-5" placeholder="Masukan Penanggung Jawab" name="penanggung_jawab" value="{{ old('penanggung_jawab') }}">
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Jabatan</label>
                <div class="col-md-9">
                    <input type="texxt" class="form-control m-b-5" placeholder="Masukan Jabatan" name="jabatan" value="{{ old('jabatan') }}">
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Alamat Pusat</label>
                <div class="col-md-9">
                    <input type="texxt" class="form-control m-b-5" placeholder="Masukan Alamat Pusat" name="alamat_pusat" value="{{ old('alamat_pusat') }}">
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Alamat Perwakilan</label>
                <div class="col-md-9">
                    <input type="texxt" class="form-control m-b-5" placeholder="Masukan Alamat Perwakilan" name="alamat_perwakilan" value="{{ old('alamat_perwakilan') }}">
                </div>
            </div>

            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Alamat Cabang</label>
                <div class="col-md-9">
                    <input type="texxt" class="form-control m-b-5" placeholder="Masukan Alamat Cabang" name="alamat_cabang" value="{{ old('alamat_cabang') }}">
                </div>
            </div>

            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Lokasi</label>
                <div class="col-md-9">
                    <input type="texxt" class="form-control m-b-5" placeholder="Masukan lokasi" name="lokasi" value="{{ old('lokasi') }}">
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

@endpush