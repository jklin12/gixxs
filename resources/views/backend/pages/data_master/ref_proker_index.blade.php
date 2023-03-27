@extends('backend.layouts.default')

@section('title', 'Dashboard V1')

@push('css')
<link href="/assets/backend/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
@endpush

@section('content')

<h1 class="page-header">{{ $title }}<small>{{ $subtitle }}</small></h1>

<div class="mb-2">
    <a href="{{ route('ref_proker.create') }}" class="btn btn-green btn-sm" data-toggle="modal" data-target="#addMenuModal"><i class="fa fa-plus mr-1"></i> Tambah {{ $title }}</a>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-green fade show m-b-10">
    <span class="close" data-dismiss="alert">×</span>
    <b>Success !</b> {{ $message }}
</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
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
        <div class="table-responsive  mb-2">
            <table class="table table-condensed" style="border-collapse:collapse;">

                <thead>
                    <tr>
                      
                        <th >No.</th>
                        <th>Nama</th> 
                        <th colspan="3" class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($data as $key => $value)

                    <tr>
                        
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $value['ref_proker_name']}}</td>
                      
                         <td>
                            <a href="#" class="btn btn-warning btn-sm editMenuBtn" data-id="{{ $value['ref_proker_id']}}" data-name="{{ $value['ref_proker_name']}}" >
                                <i class="fa fa-edit mr-1"></i>
                                Edit
                            </a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-danger btn-sm deleteMenuBtn" data-id="{{ $value['ref_proker_id']}}" data-name="{{ $value['ref_proker_name']}}">
                                <i class="fa fa-trash mr-1"></i>
                                Hapus 
                            </a>
                        </td>
                    </tr>
                 
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <!-- end panel-body -->

</div>

<div class="modal fade" id="addMenuModal" tabindex="-1" role="dialog" aria-labelledby="addMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMenuModalLabel">Tambah Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ref_proker.store') }}" method="POST" id="add-menu-form">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama :</label>
                        <input type="text" class="form-control" id="add-name" name="ref_proker_name">
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" form="add-menu-form" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editMenuModal" tabindex="-1" role="dialog" aria-labelledby="editMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editMenuModalLabel">Edit Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="edit-menu-form">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Nama :</label>
                        <input type="text" class="form-control" id="edit-menu-name" name="ref_proker_name">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" form="edit-menu-form" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteMenuModal" tabindex="-1" role="dialog" aria-labelledby="deleteMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMenuModalLabel">Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="delete-modal-form">
                    @csrf
                    @method('DELETE')
                    Apakah anda yakin menghapus <strong id="deleteName"></strong>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" form="delete-modal-form" class="btn btn-danger">Hapus</button>
            </div>
        </div>
    </div>
</div>



@endsection

@push('scripts')
<script src="/assets/backend/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
<script>
    $('.addCatBtn').click(function() {
        $('#add-category-form #menu-id').val($(this).data('id'))
        $('#addCategoryModal').modal('show')
    });

   

    $('.editMenuBtn').click(function() {
        $('#edit-menu-form ').attr('action', '<?php echo route('ref_proker.update', '') ?>' + '/' + $(this).data('id'))

        $('#edit-menu-form #edit-menu-name').val($(this).data('name')) 

        $('#editMenuModal').modal('show')


    })

  

    $('.deleteMenuBtn').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');

        $('#delete-modal-form').attr('action', '<?php echo route('ref_proker.destroy', '') ?>/' + id)
        $('#delete-modal-form #deleteName').html(name);
        $('#deleteMenuModal').modal('show')
    })

  
</script>
@endpush