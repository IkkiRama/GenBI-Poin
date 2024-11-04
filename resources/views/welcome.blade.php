<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GenBI Point | GenBI Purwokerto</title>
        <link rel="shortcut icon" href="{{ asset('/img/LOGO GENBI_2-1.png') }}" type="image/x-icon">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                colors: {
                    clifford: '#da373d',
                }
                }
            }
        }
    </script>

    <style>
        #navigation {
            transition: transform 0.3s ease;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    </head>
    <body class="dark-bg">

        <nav class="fixed left-0 right-0 bg-transparent z-50 lg:text-black text-white lg:py-10 md:py-8 py-6 lg:px-24 md:px-12 px-5 transition-all duration-500">
            <section class="flex justify-between">
                <div class="w-1/2 flex ">
                    <a href="/">
                        <img class="w-15 h-7 md:h-14 mr-3" src="{{ asset('img/BI FIX.png') }}" alt="logo BI">
                    </a>
                    <a href="/">
                        <img class="w-15 h-7 md:h-14" src="{{ asset('img/LOGO GENBI_2-1.png') }}" alt="logo genbi purwokerto">
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="md:flex hidden gap-10 items-center justify-end w-1/4">

                    <div class="w-1/4 text-right text-white">
                        <a href="{{ url('/admin') }}" class="bg-blue-600 text-white hover:bg-blue-700 focus:outline-none transition-colors duration-300 ease-in-out px-12 py-2 rounded">
                            Masuk
                        </a>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div class="md:hidden flex gap-10 items-center justify-end w-1/4">
                    <div class="w-1/4 text-right text-white">
                        <button onclick="toggleNavigation()">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
            </section>

            <nav class="fixed left-0 top-0 h-full w-[80%] bg-white text-gray-700 shadow-lg transition-transform transform -translate-x-full" id="navigation" onclick="closeNavigation(event)">
                <div class="p-5">
                    <h2 class="text-xl font-bold mb-4">Menu</h2>
                    <hr class="mb-4" />
                    <a href="{{ url('/') }}" onclick="toggleNavigation()">
                        <span class="flex items-center hover:bg-gray-100 rounded-md p-2">
                            <i class="fas fa-home mr-3"></i> Beranda
                        </span>
                    </a>
                    <a href="{{ url('/admin/login') }}" onclick="toggleNavigation()">
                        <span class="flex items-center hover:bg-gray-100 rounded-md p-2">
                            <i class="fa-solid fa-right-to-bracket mr-3"></i> Masuk
                        </span>
                    </a>
                </div>
            </nav>



        </nav>


        <header class="grid lg:grid-cols-2 relative z-10">
            <section class="relative p-10 flex lg:flex-col sm:flex-row flex-col lg:items-end items-center lg:justify-end justify-between lg:order-1 order-2 lg:gap-0 gap-10">
                <div class="absolute top-1/2 left-[40px] -translate-y-1/2 z-10 lg:flex lg:flex-col lg:justify-center lg:items-center lg:gap-5 hidden">
                <div class="w-[1px] h-[200px] rounded-full bg-black/70 dark:bg-gray-200/70 cursor-pointer"></div>
                <div class="w-[25px] h-[25px] rounded-full bg-black/70 cursor-pointer flex items-center justify-center" style="background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);">
                    <i class="fab fa-instagram text-white"></i>
                </div>
                <div class="w-[25px] h-[25px] rounded-full bg-[#1873eb] cursor-pointer flex items-center justify-center">
                    <i class="fab fa-facebook-f text-white"></i>
                </div>
                <div class="w-[25px] h-[25px] rounded-full bg-[#f70000] cursor-pointer flex items-center justify-center">
                    <i class="fab fa-youtube text-white"></i>
                </div>
                <div class="w-[1px] h-[200px] rounded-full bg-black/70 dark:bg-gray-200/70 cursor-pointer"></div>
                </div>

                <div class="lg:w-[70%] sm:w-[60%] w-full sm:order-1 order-2 lg:mb-20 lg:absolute lg:top-1/2 lg:-translate-y-1/2">
                    <p class="text-sm md:text-lg text-gray-800 dark:text-gray-200 lg:text-right text-left">Bersama Kita Membangun Komunitas yang Kuat dan Mendukung, Memberdayakan Setiap Individu untuk Mencapai Tujuan dan Impian Mereka.</p>
                </div>

                <div class="grid lg:grid-cols-3 sm:grid-cols-2 grid-cols-3 lg:gap-5 gap-3 sm:order-2 order-1">
                <div class="cursor-pointer transition-all hover:scale-110 relative after:content-[''] after:inset-0 after:absolute after:bg-black/30 after:rounded-md hover:after:scale-0 after:scale-100 lg:col-span-1 sm:col-span-2">
                    <img src="{{ asset('img/IMG_1383.jpg') }}" alt="subheader1" class="lg:w-[170px] w-full lg:h-[170px] h-[100px] rounded-md object-cover" />
                </div>
                <div class="cursor-pointer transition-all hover:scale-110 relative after:content-[''] after:inset-0 after:absolute after:bg-black/30 after:rounded-md hover:after:scale-0 after:scale-100">
                    <img src="{{ asset('img/IMG_7292.jpg') }}" alt="subheader1" class="lg:w-[170px] w-full lg:h-[170px] h-[100px] rounded-md object-cover" />
                </div>
                <div class="cursor-pointer transition-all hover:scale-110 relative after:content-[''] after:inset-0 after:absolute after:bg-black/30 after:rounded-md hover:after:scale-0 after:scale-100">
                    <img src="{{ asset('img/IMG_1307.jpg') }}" alt="subheader1" class="lg:w-[170px] w-full lg:h-[170px] h-[100px] rounded-md object-cover" />
                </div>
                </div>

                <h1 class="absolute right-[10px] top-[30%] text-8xl font-semibold text-blue-600 lg:block hidden">GenBI</h1>
            </section>

            <section class="lg:h-[800px] h-[550px] relative after:content-[''] after:absolute after:inset-0 after:bg-black/30 lg:order-2 order-1">
                <img id="headerImg" src="{{ asset('img/IMG_7290.jpg') }}" alt="headerImg" class="h-full w-full object-cover" />
                <div class="absolute top-1/2 sm:right-[40px] right-[20px] -translate-y-1/2 z-10 flex flex-col justify-center items-center gap-10">
                <div class="w-[1px] lg:h-[200px] h-[100px] rounded-full bg-white/70 cursor-pointer"></div>
                <div class="w-[15px] h-[15px] rounded-full bg-red-500/70 cursor-pointer flex items-center justify-center">
                    <h6 class="text-3xl text-white font-bold">1</h6>
                </div>
                <div class="w-[15px] h-[15px] rounded-full bg-red-500/70 cursor-pointer flex items-center justify-center">
                    <h6 class="text-3xl text-white font-bold">2</h6>
                </div>
                <div class="w-[15px] h-[15px] rounded-full bg-red-500/70 cursor-pointer flex items-center justify-center">
                    <h6 class="text-3xl text-white font-bold">3</h6>
                </div>
                <div class="w-[1px] lg:h-[200px] h-[100px] rounded-full bg-white/70 cursor-pointer"></div>
                </div>

                <h1 class="absolute lg:left-[10px] left-[80px] sm:-translate-x-0 -translate-x-1/2 md:top-[30%] top-1/2 md:text-8xl sm:text-7xl text-5xl sm:text-left text-center font-semibold text-white z-10">
                <span class="text-[#025496] block lg:hidden">GenBI</span>
                Point
                </h1>
            </section>
        </header>
    </body>

    <script>
        // Fungsi untuk men-toggle navigasi
        function toggleNavigation() {
            const nav = document.getElementById('navigation');
            nav.classList.toggle('-translate-x-full'); // Tampilkan/ sembunyikan navigasi
        }

        function closeNavigation(event) {
            const nav = document.getElementById('navigation');
            if (event.target === nav) { // Cek jika klik di luar area
                nav.classList.add('-translate-x-full'); // Sembunyikan navigasi
            }
        }


        // Fungsi untuk mengganti mode (terang/gelap)
        const changeModeButton = document.getElementById("changeMode");
        changeModeButton.addEventListener("click", () => {
            document.body.classList.toggle("dark");
            // Simpan preferensi mode ke localStorage (opsional)
            if (document.body.classList.contains("dark")) {
                localStorage.setItem("mode", "dark");
            } else {
                localStorage.setItem("mode", "light");
            }
        });

        // Memeriksa preferensi mode saat halaman dimuat
        window.onload = () => {
            const mode = localStorage.getItem("mode");
            if (mode === "dark") {
                document.body.classList.add("dark");
            }
        };
    </script>

</html>
