<footer class="bg-primary-900 py-8">
    <div class="container">
        <div class="grid lg:grid-cols-3 gap-8">
            <div>
                <section class="flex items-center">
                    <img src="assets/img/logo.png" alt="logo" class="object-contain h-16 my-2 mr-4">
                    <div>
                        <h2 class="text-lg font-bold text-primary">{{ config('site.site_name');  }}</h2>
                        <p class="text-xs text-gray-100">{{ config('site.site_desc');  }}</p>
                    </div>
                </section>

                <h5 class="text-white font-bold text-lg mt-8">{{config('site.contact.name')}}</h5>
                <p class="text-white text-sm mt-4">{{config('site.contact.address')}}</p>
                <p class="text-white text-sm mt-4">Telp: {{config('site.contact.phone')}}</p>
                <p class="text-white text-sm mt-4">Email: {{config('site.contact.email')}}</p>
            </div>
            <div>
                <h6 class="border-l-4 border-primary px-4 py-2 font-semibold text-lg relative bg-gray-700 text-white mb-4" data-aos="fade-left" data-aos-offset="100">
                    Instansi Lain
                </h6>
                <a href="#" class="block text-gray-300 hover:text-white py-4 border-b border-gray-500">Dinas Kesehatan Kutai Timur</a>
                <a href="#" class="block text-gray-300 hover:text-white py-4 border-b border-gray-500">Dinas Pendidikan Kutai Timur</a>
                <a href="#" class="block text-gray-300 hover:text-white py-4 border-b border-gray-500">Dinas Pariwisata Kutai Timur</a>
                <a href="#" class="block text-gray-300 hover:text-white py-4 border-b border-gray-500">Disdukcapil Kutai Timur</a>
            </div>

        </div>
    </div>
</footer>