@extends('backend.layouts.default')

@section('title', 'Dashboard V1')

@push('css')
<link href="/assets/backend/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
@endpush

@section('content')

<h1 class="page-header">{{ $title }}<small>{{ $subtitle }}</small></h1>

<div class="mb-2">
    <a href="{{ route('menu.create') }}" class="btn btn-primary" data-toggle="modal" data-target="#addMenuModal"><i class="fa fa-add"></i> Tambah Menu</a>
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
                        <th colspan="2">No.</th>
                        <th>Menu</th>
                        <th>Tampil</th>
                        <td colspan="3" class="text-center">Action</td>
                    </tr>
                </thead>

                <tbody>
                    @foreach($data as $key => $value)

                    <tr>
                        <td>
                            <a href="#" class="btn btn-primary btn-icon btn-circle btn-sm accordion-toggle" data-toggle="collapse" data-target="#category-{{$key}}">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $value['menu_name']}}</td>
                        <td>{{ $value['menu_show'] ? 'Ya' : 'Tidak'}}</td>
                        <td>
                            <a href="#" class="btn btn-success btn-icon btn-circle addCatBtn" data-id="{{ $value['menu_id']}}">
                                <i class="fa fa-plus"></i>
                            </a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-warning btn-icon btn-circle editMenuBtn" data-id="{{ $value['menu_id']}}" data-name="{{ $value['menu_name']}}" data-display="{{ $value['menu_show'] ?? 0 }}">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-danger btn-icon btn-circle deleteMenuBtn" data-id="{{ $value['menu_id']}}" data-name="{{ $value['menu_name']}}">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <tr class="border: none;">
                        <td colspan="12" class="hiddenRow">
                            <div class="accordian-body collapse" id="category-{{$key}}">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td>No.</td>
                                            <td>Category</td>
                                            <td>Tampil</td>
                                            <td>Color</td>
                                            <td>Opacity</td>
                                            <td colspan="2" class="text-center">Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(isset($value['category_data']))
                                        @foreach($value['category_data'] as $kcat => $vcat)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{ $vcat['category_name']}}</td>
                                            <td>{{ $vcat['display']}}</td>
                                            <td><span class="badge badge-primary" style="background-color: {{ $vcat['fill_color']}};">{{ $vcat['fill_color']}}</span></td>
                                            <td>{{ $vcat['fill_opacity']}}</td>

                                            <td>
                                                <a href="#" class="btn btn-warning btn-icon btn-circle btnEditCategory" data-id="{{ $vcat['category_id']}}" data-menu="{{ $vcat['menu']}}" data-name="{{ $vcat['category_name']}}" data-display="{{ $vcat['display'] ?? 0 }}" data-color="{{ $vcat['fill_color']}}" data-opacity="{{ $vcat['fill_opacity']}}">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-danger btn-icon btn-circle deleteCatBtn" data-id="{{ $vcat['category_id']}}" data-name="{{ $vcat['category_name']}}">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            </div>
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
                <form action="{{ route('menu.store') }}" method="POST" id="add-menu-form">
                    @csrf
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Menu :</label>
                        <input type="text" class="form-control" id="add-name" name="menu_name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Tampil:</label>
                        <select class="form-control" id="add-tampil-menu" name="menu_display">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
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
                        <label for="recipient-name" class="col-form-label">Menu :</label>
                        <input type="text" class="form-control" id="edit-menu-name" name="menu_name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Tampil :</label>
                        <select class="form-control" id="edit-menu-display" name="menu_show" autocomplete="off">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
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


<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('category.store') }}" method="POST" id="add-category-form">
                    @csrf
                    <input type="hidden" name="menu_id" id="menu-id">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Category :</label>
                        <input type="text" class="form-control" id="add-name" name="category_name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Tampil:</label>
                        <select class="form-control" id="add-tampil-category" name="display">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Color :</label>
                        <div class="input-group">
                            <input class="form-control" name="fill_color" id="add-category-color" data-id="color-palette-1" />
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
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Opacity :</label>
                        <input type="number" step="any" class="form-control" id="add-opacity" name="fill_opacity">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" form="add-category-form" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="POST" id="edit-category-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="menu_id" id="edit-category-menu">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Category :</label>
                        <input type="text" class="form-control" id="edit-category-name" name="category_name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Tampil :</label>
                        <select class="form-control" id="edit-category-display" name="display" autocomplete="off">
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Color :</label>
                        <div class="input-group">
                            <input class="form-control" name="fill_color" id="edit-color" data-id="color-palette-1" />
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
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Opacity :</label>
                        <input type="number" step="any" class="form-control" id="edit-opacity" name="fill_opacity">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" form="edit-category-form" class="btn btn-primary">Simpan</button>
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

    $('.btnEditCategory').click(function() {
        $('#edit-category-form ').attr('action', '<?php echo route('category.update', '') ?>' + '/' + $(this).data('id'))

        $('#edit-category-form #edit-category-menu').val($(this).data('menu'))
        $('#edit-category-form #edit-category-name').val($(this).data('name'))
        $('#edit-category-form #edit-category-display').val($(this).data('display')).change()
        $('#edit-category-form #edit-opacity').val($(this).data('opacity'))
        $('#edit-category-form #edit-color').val($(this).data('color'))

        $('#editCategoryModal').modal('show')


    })

    $('.editMenuBtn').click(function() {
        $('#edit-menu-form ').attr('action', '<?php echo route('menu.update', '') ?>' + '/' + $(this).data('id'))

        $('#edit-menu-form #edit-menu-name').val($(this).data('name'))
        $('#edit-menu-form #edit-menu-display').val($(this).data('display')).change()

        $('#editMenuModal').modal('show')


    })

    $('.deleteCatBtn').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');

        $('#delete-modal-form').attr('action', '<?php echo route('category.destroy', '') ?>/' + id)
        $('#delete-modal-form #deleteName').html(name);
        $('#deleteMenuModal').modal('show')
    })

    $('.deleteMenuBtn').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');

        $('#delete-modal-form').attr('action', '<?php echo route('menu.destroy', '') ?>/' + id)
        $('#delete-modal-form #deleteName').html(name);
        $('#deleteMenuModal').modal('show')
    })

    $('#color-palette-1').colorPalette().on('selectColor', function(e) {
        $('[data-id="color-palette-1"]').val(e.color);
    });
</script>
@endpush