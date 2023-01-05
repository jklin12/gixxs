<nav class="fixed z-50 bg-gray-900 bg-opacity-75 shadow-lg w-full">
        <div class="container flex justify-between items-center">
            <section class="flex items-center">
                <img src="assets/img/logo.png" alt="logo" class="object-contain h-16 my-2 mx-4">
                <div>
                    <h2 class="text-xl font-bold text-primary">{{ config('site.site_name');  }}</h2>
                    <p class="text-sm text-gray-100">{{ config('site.site_desc');  }}</p>
                </div>
            </section>

            <section class="hidden lg:flex space-x-8 mx-8">
                <a class="font-semibold text-gray-100 hover:text-primary capitalize" href="{{ route('home') }}" target="">Home</a>
                <a class="font-semibold text-gray-100 hover:text-primary capitalize" href="{{ route('ijinLingkungan') }}" target="">Ijin Lingkungan</a>
                <a class="font-semibold text-gray-100 hover:text-primary capitalize" href="{{ route('kes') }}" target="">Kawasan Ekosistem Esensial</a>
                <a class="font-semibold text-gray-100 hover:text-primary capitalize" href="{{ route('dkl') }}" target="">Dokumen Kajian Lingkungan</a>
                <a class="font-semibold text-gray-100 hover:text-primary capitalize" href="{{ route('sppl') }}" target="">SPPL</a>
                <a class="font-semibold text-gray-100 hover:text-primary capitalize" href="{{ route('peta') }}" target="">GIS</a>
            </section>
        </div>
    </nav>
  