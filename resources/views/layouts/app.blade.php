<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipena</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />

    {{-- Vite CSS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<script>
    const navToggle = document.getElementById('navToggle');
    const mobileMenu = document.getElementById('mobileMenu');

    navToggle.addEventListener('click', () => {
        mobileMenu.classList.toggle('tw-hidden');
    });
</script>

<body class="tw-bg-gray-50 tw-font-inter">

    {{-- ======== NAVBAR (sementara) ======== --}}
    <x-navbar />
    {{-- <nav class="tw-bg-white tw-shadow-sm tw-py-3">
        <div class="tw-container tw-mx-auto tw-flex tw-items-center tw-justify-between tw-px-4">

            <a href="/" class="tw-text-2xl tw-font-bold tw-text-red-600">
                Sipena
            </a>

            <div class="tw-flex tw-items-center tw-gap-3">
                <p class="tw-font-medium tw-text-gray-700">Hi, User</p>
                <img src="/images/people.png" class="tw-h-10 tw-w-10 tw-rounded-full tw-object-cover">
            </div>
        </div>
    </nav> --}}


    {{-- ======== MAIN PAGE CONTENT ======== --}}
    <main class="tw-min-h-screen">
        @yield('content')
    </main>


    {{-- ======== FOOTER (optional) ======== --}}
    <x-footer />
    {{-- <footer class="tw-text-center tw-text-gray-600 tw-text-sm tw-py-5 tw-border-t tw-mt-20">
        &copy; {{ date('Y') }} Sipena • Sistem Informasi Penerimaan Asisten Praktikum
    </footer> --}}

</body>

</html>
