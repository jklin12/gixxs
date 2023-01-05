@extends('layouts.default')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
@endpush

@section('content')
<header class="relative h-96">
    <img src="https://source.unsplash.com/1600x900/?landscape" class="object-cover w-full h-full absolute inset-0">
    <div class="bg-black bg-opacity-25 w-full h-full flex flex-col justify-center items-center absolute z-10 inset-0">
        <h2 class="text-white text-5xl font-bold mt-12">
            {{ $title }}
        </h2>
    </div>
</header>
<section class="mt-20 container " style="margin-bottom: 5rem;">
    <div class="grid lg:grid-cols-3 gap-8">
        <main class="lg:col-span-2">
            <div class="grid gap-8">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Berkas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key=>$value)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $value->sppl_name }} </td>
                            <td class="text-center"><a href="#" class="btn btn-primary"><i class="fas fa-download"></i></a></td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>



        
    </div>
</section>
@endsection
@push('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
</script>
@endpush