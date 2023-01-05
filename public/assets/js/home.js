
AOS.init({
    once: true
})

const data = {
    labels: ['Baik', 'Sedang', 'Rusak Ringan', 'Rusak Berat'],
    datasets: [{
        data: [212000, 153000, 57000, 16000],
        backgroundColor: ['#36A2EB', '#4BC0C0', '#FFCD56', '#FF6384'],
    }]
}

const config = {
    type: 'doughnut',
    data: data,
    options: {
        animation: false,
        responsive: true,
        plugins: {
            legend: {
                position: 'right',
            }
        }
    },
}

const jalanChart = document.getElementById('jalan-chart').getContext('2d')
const jembatanChart = document.getElementById('jembatan-chart').getContext('2d')
const wisataChart = document.getElementById('wisata-chart').getContext('2d')
const sekolahChart = document.getElementById('sekolah-chart').getContext('2d')
new Chart(jalanChart, config)
new Chart(jembatanChart, config)
new Chart(wisataChart, config)
new Chart(sekolahChart, config)

const swiper = new Swiper('.swiper', {
    loop: true,
    slidesPerView: 2,
    spaceBetween: 32,
    autoplay: true,
    delay: 2000,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
})
new Glide('#highlight-carousel', {
    type: 'carousel',
    perView: 2,
    gap: 32,
    autoplay: 2000,
    breakpoints: {
        1024: {
            perView: 1
        }
    }
}).mount() 