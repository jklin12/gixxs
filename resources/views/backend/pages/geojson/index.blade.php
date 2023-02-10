@extends('backend.layouts.default')

@section('title', 'Dashboard V1')

@push('css')
<link href="/assets/backend/plugins/jstree/dist/themes/default/style.min.css" rel="stylesheet" />
@endpush

@section('content')

<h1 class="page-header">{{ $title }}<small>{{ $subtitle }}</small></h1>

<div class="mb-2">
    <a href="{{ route('geojson.create') }}" class="btn btn-green btn-sm"><i class="fa fa-plus  mr-1 "></i>Tambah Data</a>
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
                <li data-jstree='{"opened":true}'>
                    {{ $vmenu['menu_name']}}
                    @if(isset($vmenu['category_data']))
                    <ul>

                        @foreach($vmenu['category_data'] as $kcat => $vcat)
                        <li data-jstree='{"opened":true}'>
                            {{ $vcat['category_name']}}
                            @if(isset($vcat['geojson_data']))
                            <ul>
                                @foreach($vcat['geojson_data'] as $kjson => $vjson)

                                <li data-jstree='{ "icon" : "fa fa-link fa-lg text-primary" }'><a href="{{route('geojson.show',$vjson['geojson_id']?? '0')}}">{{ $vjson['geojson_name']}}</a></li>

                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach

                    </ul>
                    @endif
                </li>
                @endif
                @endforeach

            </ul>
        </div>

    </div>
    <!-- end panel-body -->

</div>


@endsection

@push('scripts')
<script src="/assets/backend/plugins/jstree/dist/jstree.min.js"></script>
<script src="/assets/backend/js/demo/ui-tree.demo.js"></script>
<script>
   
</script>
@endpush