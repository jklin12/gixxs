@extends('backend.layouts.default')

@section('title', 'Dashboard V1')

@push('css')
<link href="/assets/backend/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" />
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
        <div id="jstree-default">
            <ul>
                @foreach($data as $kmenu => $vmenu)
                @if($vmenu)
                <li>
                    {{ $vmenu['menu_name']}}
                    <ul>
                        
                        @foreach($vmenu['category_data'] as $kcat => $vcat)
                       
                        <li>
                            <a href="{{ route('geojson.show',$vgeo['category_id']?? '0') }}">{{ $vcat['category_name']}}</a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endif
                @endforeach

            </ul>
        </div>

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
                <form method="post" id="formDelete">
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
<script src="/assets/backend/plugins/jstree/dist/jstree.min.js"></script>
<script src="/assets/backend/js/demo/ui-tree.demo.js"></script>
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