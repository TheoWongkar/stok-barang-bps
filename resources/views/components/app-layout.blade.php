<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Metadata -->
    <meta name="description"
        content="Aplikasi ini merupakan sistem manajemen stok barang berbasis web yang dirancang khusus untuk memudahkan admin dalam mengelola persediaan barang di gudang atau instansi.">
    <meta name="keywords" content="bps sulut, pegawai bps, stok barang, barang masuk, barang keluar">
    <meta name="author" content="BPS Sulut">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/application-logo.svg') }}" type="image/x-icon">

    <!-- Judul Halaman -->
    <title>Stok Barang BPS</title>

    <!-- Framework Frontend -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Script Tambahan -->
    @isset($script)
        {{ $script }}
    @endisset

    <!-- Default CSS -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="antialiased">

    <div x-data="{ sidebarOpen: false }" class="relative h-screen flex overflow-hidden" x-cloak>

        <!-- Navigasi -->
        @include('components.partials.app-navigation')

        <!-- Layout Utama -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            @include('components.partials.app-header')

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6 bg-gray-100">
                {{ $slot }}
            </main>
        </div>
    </div>

</body>

</html>
