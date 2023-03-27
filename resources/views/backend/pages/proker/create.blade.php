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
        <form action="{{ route('proker.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Referensi</label>
                <div class="col-md-9">
                    <select class="form-control" name="ref_proker_id" value="{{ old('ref_proker_id') }}">
                        <option value=""></option>
                        @foreach($refs as $key => $ref)
                        <option value="{{ $ref->ref_proker_id}}">{{ $ref->ref_proker_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Judul</label>
                <div class="col-md-9">
                    <input type="texxt" class="form-control m-b-5" placeholder="Masukan Judul" name="proker_title" value="{{ old('proker_title') }}">
                </div>
            </div>
        
            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-3">Isi</label>
                <div class="col-md-9">
                    <textarea class="ckeditor" id="editor1" name="proker_body" rows="20">{{ old('proker_body') }}</textarea>
                </div>
            </div>
           

            <button type="submit" class="btn btn-primary m-r-5 m-b-5">Simpan</button>
        </form>

    </div>
    <!-- end panel-body -->

</div>
@endsection

@push('scripts')
<script src="/assets/backend/plugins/ckeditor/ckeditor.js"></script>

@endpush