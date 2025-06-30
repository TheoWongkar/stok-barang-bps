{{-- Overlay --}}
<div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-20 transition-opacity md:hidden"
    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
</div>

{{-- Sidebar --}}
<div :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-[#486284] text-white md:translate-x-0 md:static md:inset-0 flex flex-col shadow-xl">

    {{-- Header Sidebar --}}
    <div class="px-4 py-4 flex items-center space-x-3">
        <img src="{{ asset('img/application-logo.svg') }}" alt="Logo BPPD Sulut" class="w-12 h-12 shrink-0">
        <div class="flex flex-col">
            <h3 class="text-sm font-semibold leading-tight uppercase">Badan Pusat Statistik</h3>
            <span class="text-xs">Provinsi Sulawesi Utara</span>
        </div>
    </div>

    {{-- Navigasi --}}
    <nav class="flex-1 overflow-y-auto px-4 py-4 space-y-4">

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}"
            class="flex items-center space-x-3 px-4 py-2 rounded hover:bg-[#3c516d] {{ Route::is('dashboard') ? 'bg-[#5b7a9f]' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-house-door-fill" viewBox="0 0 16 16">
                <path
                    d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5" />
            </svg>
            <span class="text-sm font-bold">Dashboard</span>
        </a>

        {{-- Data Pegawai --}}
        <a href="{{ route('dashboard.employee.index') }}"
            class="flex items-center space-x-3 px-4 py-2 rounded hover:bg-[#3c516d] {{ Route::is('dashboard.employee.*') ? 'bg-[#5b7a9f]' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
                <path
                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5M9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8m1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5m-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96q.04-.245.04-.5M7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0" />
            </svg>
            <span class="text-sm font-bold">Data Pegawai</span>
        </a>

        {{-- Data Barang --}}
        <a href="{{ route('dashboard.item.index') }}"
            class="flex items-center space-x-3 px-4 py-2 rounded hover:bg-[#3c516d] {{ Route::is('dashboard.item.*') ? 'bg-[#5b7a9f]' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003zM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z" />
            </svg>
            <span class="text-sm font-bold">Data Barang</span>
        </a>

        {{-- Barang Masuk --}}
        <a href="{{ route('dashboard.stockin.index') }}"
            class="flex items-center space-x-3 px-4 py-2 rounded hover:bg-[#3c516d] {{ Route::is('dashboard.stockin.*') ? 'bg-[#5b7a9f]' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-mailbox2" viewBox="0 0 16 16">
                <path d="M9 8.5h2.793l.853.854A.5.5 0 0 0 13 9.5h1a.5.5 0 0 0 .5-.5V8a.5.5 0 0 0-.5-.5H9z" />
                <path
                    d="M12 3H4a4 4 0 0 0-4 4v6a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V7a4 4 0 0 0-4-4M8 7a4 4 0 0 0-1.354-3H12a3 3 0 0 1 3 3v6H8zm-3.415.157C4.42 7.087 4.218 7 4 7s-.42.086-.585.157C3.164 7.264 3 7.334 3 7a1 1 0 0 1 2 0c0 .334-.164.264-.415.157" />
            </svg>
            <span class="text-sm font-bold">Barang Masuk</span>
        </a>

        {{-- Barang Keluar --}}
        <a href="{{ route('dashboard.stockout.index') }}"
            class="flex items-center space-x-3 px-4 py-2 rounded hover:bg-[#3c516d] {{ Route::is('dashboard.stockout.*') ? 'bg-[#5b7a9f]' : '' }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-mailbox2-flag" viewBox="0 0 16 16">
                <path d="M10.5 8.5V3.707l.854-.853A.5.5 0 0 0 11.5 2.5v-2A.5.5 0 0 0 11 0H9.5a.5.5 0 0 0-.5.5v8z" />
                <path
                    d="M4 3h4v1H6.646A4 4 0 0 1 8 7v6h7V7a3 3 0 0 0-3-3V3a4 4 0 0 1 4 4v6a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V7a4 4 0 0 1 4-4m.585 4.157C4.836 7.264 5 7.334 5 7a1 1 0 0 0-2 0c0 .334.164.264.415.157C3.58 7.087 3.782 7 4 7s.42.086.585.157" />
            </svg>
            <span class="text-sm font-bold">Barang Keluar</span>
        </a>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full text-left flex items-center space-x-3 px-4 py-2 rounded hover:bg-[#3c516d] text-red-100 cursor-pointer hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                    <path fill-rule="evenodd"
                        d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z" />
                </svg>
                <span class="text-sm font-bold">Logout</span>
            </button>
        </form>
    </nav>
</div>
