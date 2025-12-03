<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipena</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Tailwind (Vite) – harus dipasang setelah Bootstrap --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        /* ==== COMPACT DATATABLE ==== */
        table.dataTable thead th {
            padding: 6px 8px !important;
            font-size: 13px !important;
            white-space: nowrap;
        }

        table.dataTable tbody td {
            padding: 6px 8px !important;
            font-size: 13px !important;
        }

        table.dataTable {
            width: 100% !important;
        }

        .dataTables_wrapper .dataTables_filter input {
            height: 32px !important;
            font-size: 13px !important;
        }

        .dataTables_wrapper .dataTables_length select {
            height: 32px !important;
            font-size: 13px !important;
        }

        .dataTables_wrapper {
            margin-top: 0 !important;
        }
    </style>

</head>

<body class="tw-bg-gray-50 tw-font-inter tw-min-h-screen tw-flex tw-flex-col">

    {{-- ======== NAVBAR ======== --}}
    <header class="tw-w-full tw-z-50">
        <x-navbar />
    </header>

    {{-- ======== MAIN PAGE CONTENT ======== --}}
    <main class="tw-flex-1 tw-py-6 tw-px-4 md:tw-px-8 tw-mt-4">
        @yield('content')
    </main>

    {{-- ======== FOOTER ======== --}}
    <footer class="tw-w-full tw-bg-white tw-shadow-inner tw-py-4 tw-mt-4">
        <x-footer />
    </footer>

    <script>
        window.HSSelect?.init();
    </script>

</body>

</html>
