<x-app-layout>

    {{-- Judul Halaman --}}
    <x-slot name="title">Data Barang</x-slot>

    {{-- Bagian Data Barang --}}
    <section>
        {{-- Header: Tombol Tambah & Search --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            {{-- Tombol Tambah Barang --}}
            <a href="{{ route('dashboard.item.create') }}"
                class="w-full md:w-auto px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow text-center">
                Tambah Barang
            </a>

            {{-- Form Search --}}
            <form method="GET" action="{{ route('dashboard.item.index') }}" class="w-full md:w-1/3 flex">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / SKU..." autocomplete="off"
                    class="flex-grow px-4 py-2 border border-gray-300 rounded-l-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

                <button type="submit"
                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-r-lg shadow-sm">
                    Cari
                </button>
            </form>
        </div>

        {{-- Notifikasi Sukses --}}
        @if (session('success'))
            <div
                class="mb-4 px-4 py-3 bg-green-100 border border-green-300 text-green-800 text-sm rounded-lg shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Notifikasi Error --}}
        @if (session('error'))
            <div class="mb-4 px-4 py-3 bg-red-100 border border-red-300 text-red-800 text-sm rounded-lg shadow-sm">
                {{ session('error') }}
            </div>
        @endif

        {{-- Table Wrapper --}}
        <div class="overflow-x-auto bg-white border border-gray-200 rounded-xl shadow-sm">
            <table class="min-w-full text-sm text-gray-700">
                <thead class="bg-[#486284] text-xs text-white uppercase tracking-wide">
                    <tr>
                        <th class="px-2 py-3 text-center">#</th>
                        <th class="px-4 py-3 text-left">Nama Barang</th>
                        <th class="px-4 py-3 text-left">Deskripsi</th>
                        <th class="px-4 py-3 text-left">SKU</th>
                        <th class="px-4 py-3 text-center">Stok</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($items as $item)
                        <tr class="hover:bg-blue-50">
                            <td class="px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 font-medium">{{ Str::limit($item->name, 25, '...') }}</td>
                            <td class="px-4 py-2 font-medium">{{ Str::limit($item->description, 25, '...') }}</td>
                            <td class="px-4 py-2">{{ $item->sku }}</td>
                            <td class="px-4 py-2 text-center">{{ $item->stock }}</td>
                            <td class="px-4 py-2 space-x-2 text-center">
                                <a href="{{ route('dashboard.item.edit', $item->id) }}"
                                    class="text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('dashboard.item.destroy', $item->id) }}" method="POST"
                                    class="inline" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 cursor-pointer hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500">Data barang belum tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $items->links('vendor.pagination.default') }}
        </div>
    </section>

</x-app-layout>
