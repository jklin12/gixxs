@extends('layouts.default')

@section('content')
<div class="w-screen overflow-x-hidden">
    <header class="h-screen">
        <div class="h-full relative">
            <video width="100%" height="100%" autoplay muted loop class="object-cover absolute right-0 bottom-0 min-w-full min-h-full" poster="assets/img/home-bg.jpeg">
            </video>

            <div class="absolute inset-0 bg-black opacity-50"></div>
            <section class="relative h-full w-full flex flex-col justify-center items-center">
                <h2 class="capitalize text-white lg:text-4xl font-bold text-lg mb-4" data-aos-delay="500">{{ config('site.site_name');  }}</h2>

                <h2 class="capitalize text-white lg:text-3xl text-lg mb-4" data-aos-delay="500">{{ config('site.site_desc');  }}</h2>

                <div class="relative lg:mt-32 mt-16 lg:mb-0 mb-24 lg:w-1/2" data-aos-delay="1000">
                    <input name="search" type="text" id="search" placeholder="Cari Ijin..." class="text-2xl w-full bg-white opacity-75 focus:opacity-100 shadow p-4 rounded-full" />
                    <button class="absolute right-0 top-0 bottom-0 px-6">
                        <i class="fas fa-search text-primary text-2xl"></i>
                    </button>
                </div>
            </section>
        </div>
    </header>

    <section class="absolute w-full transform -translate-y-1/2 z-30">
        <div class="container">
            <div class="bg-gray-900 bg-opacity-75 p-8" id="highlight-carousel">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        @foreach($galery as $kg => $vg)
                        <li class="glide__slide">
                            <a href="" class="hover:text-primary block text-gray-200" data-aos="none" data-aos-offset="100">
                                <article class="grid gap-4 lg:grid-cols-5 lg:gap-8">
                                    <div class=" lg:col-span-2 aspect-w-16 aspect-h-9 max-w-full ">
                                        <img src="{{ $vg->file }}" class="w-full max-w-full object-cover">
                                    </div>
                                    <span class="lg:col-span-3">
                                        <div class="flex mb-4 items-center space-x-4">
                                            <div class="flex space-x-4">
                                                <time class="text-gray-200 text-xs" datetime="">
                                                    <i class="fas fa-calendar-alt text-primary"></i> &nbsp;{{ $vg->created_at}}
                                                </time> 
                                            </div>
                                        </div>
                                        <h2 class=" text-lg font-bold mb-4 leading-relaxed ">
                                            {{ $vg->title }}
                                        </h2>
                                        <p style="color: white;">
                                            {{ $vg->body }}
                                        </p>
                                    </span>

                                </article>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="glide__arrows w-full flex justify-center -mb-4 mt-4 space-x-4" data-glide-el="controls">
                    <button class="glide__arrow glide__arrow--left bg-gray-500 bg-opacity-75 w-8 h-8 flex items-center justify-center rounded-lg" data-glide-dir="<">
                        <i class="fas fa-angle-left text-3xl text-white"></i>
                    </button>
                    <button class="glide__arrow glide__arrow--right bg-gray-500 bg-opacity-75 w-8 h-8 flex items-center justify-center rounded-lg" data-glide-dir=">">
                        <i class="fas fa-angle-right text-3xl text-white"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>


    <section class="pb-20 lg:pt-56 pt-80 bg-gradient-to-b from-primary to-primary-darker">
        <div class="container">
            <div class="grid gap-4 lg:grid-cols-3">
                <div class="lg:flex lg:space-x-4 lg:col-span-2">
                    <div class="relative shadow-lg">
                        <img src="assets/img/person1.jpg" alt="Drs. H. Ardiansyah Sulaiman, M. Si" class="object-cover w-full h-full">
                        <div class="bg-white bg-opacity-75 absolute bottom-0 w-full py-4">
                            <h4 class="text-center text-sm font-semibold">Drs. H. Ardiansyah Sulaiman, M. Si</h4>
                            <h5 class="text-center text-sm mt-2">Bupati Kutai Timur</h5>
                        </div>
                    </div>
                    <div class="relative shadow-lg">
                        <img src="assets/img/person2.jpg" alt="Dr. H. Kasmidi Bulang, S.T., M.M" class="object-cover w-full h-full">
                        <div class="bg-white bg-opacity-75 absolute bottom-0 w-full py-4">
                            <h4 class="text-center text-sm font-semibold">Dr. H. Kasmidi Bulang, S.T., M.M</h4>
                            <h5 class="text-center text-sm mt-2">Wakil Bupati Kutai Timur</h5>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col justify-center">
                    <h2 class="italic text-2xl text-white text-center secondary-font leading-relaxed">
                        "Membangun, Meningkatkan, dan Memelihara Jalan dan Jembatan Kutai Timur"
                    </h2>
                    <h3 class="text-center text-white font-semibold text-lg mt-8">
                        - Dinas PUPR Kutai Timur
                    </h3>
                </div>
            </div>
        </div>
    </section>

    <section class="container grid grid-cols-4 gap-8 mt-20">
        <a href="{{ route('ijinLingkungan') }}" class="block bg-white shadow-lg rounded-xl p-4 flex flex-col items-center transition-transform ease-out hover:scale-110">
            <img src="assets/img/undraw_navigator.png" class="mb-4 object-contain h-28">
            <h3 class="text-center font-semibold mb-2">Ijin Lingkungan</h3>
            <h4 class="text-center text-gray-700 text-sm">Ijin Lingkungan &amp; Jembatan Kabupaten Kutai Timur</h4>
        </a>
        <a href="{{ route('kes') }}" class="block bg-white shadow-lg rounded-xl p-4 flex flex-col items-center transition-transform ease-out hover:scale-110">
            <img src="assets/img/undraw_town.png" class="mb-4 object-contain h-28">
            <h3 class="text-center font-semibold mb-2">Kawasan Ekosistem Esensial</h3>
            <h4 class="text-center text-gray-700 text-sm">Kawasan Ekosistem Esensial Di Kabupaten Kutai Timur</h4>
        </a>
        <a href="{{ route('dkl') }}" class="block bg-white shadow-lg rounded-xl p-4 flex flex-col items-center transition-transform ease-out hover:scale-110">
            <img src="assets/img/undraw_building.png" class="mb-4 object-contain h-28">
            <h3 class="text-center font-semibold mb-2">Dokumen Kawasan Lingkungan</h3>
            <h4 class="text-center text-gray-700 text-sm">Dokumen Kawasan Lingkungan Kabupaten Kutai Timur</h4>
        </a>

        <a href="{{ route('sppl') }}" class="block bg-white shadow-lg rounded-xl p-4 flex flex-col items-center transition-transform ease-out hover:scale-110">
            <img src="assets/img/undraw_water.png" class="mb-4 object-contain h-28">
            <h3 class="text-center font-semibold mb-2">SPPL</h3>
            <h4 class="text-center text-gray-700 text-sm">SPPL</h4>
        </a>

    </section>

    <section class="pt-20 pb-20 container" id="satu-peta">
        <div class="border-4 bg-white border-primary rounded-xl p-1 relative flex flex-col items-center shadow-xl">
            <h4 class="shadow-lg text-2xl text-white font-bold bg-primary rounded-lg absolute top-0 px-6 py-2 -translate-y-2/4">SATU PETA</h4>
            <div class="overflow-hidden rounded-xl w-full">
                <iframe src="{{ route('peta')}}" width="100%" height="650"></iframe>
            </div>
        </div>
    </section>




</div>
@endsection