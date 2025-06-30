<x-app-layout>

    {{-- Judul Halaman --}}
    <x-slot name="title">Barang Keluar</x-slot>

    {{-- Bagian Data Barang Keluar --}}
    <section>
        {{-- Header: Tombol dan Search --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <div x-data="{ open: false, selectedItem: null, items: @js($items) }">

                {{-- Tombol Tambah Barang Keluar --}}
                <button @click="open = true"
                    class="w-full md:w-auto px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow text-center cursor-pointer">
                    Tambah Barang Keluar
                </button>

                {{-- Modal Form --}}
                <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" x-cloak>
                    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg relative">
                        <h2 class="text-xl font-semibold mb-4">Tambah Barang Keluar</h2>

                        <form method="POST" action="{{ route('dashboard.stockout.store') }}" class="space-y-4">
                            @csrf

                            <div class="md:flex md:gap-6">
                                {{-- Kolom Kiri --}}
                                <div class="md:w-1/2 space-y-4">
                                    {{-- Pilih Barang --}}
                                    <div>
                                        <label for="item_id" class="block text-sm font-medium text-gray-700">Nama
                                            Barang</label>
                                        <select name="item_id" x-model="selectedItem"
                                            @change="selectedItem = $event.target.value" required
                                            class="mt-1 w-full px-2 py-1.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500 transition">
                                            <option value="">-- Pilih Barang --</option>
                                            <template x-for="item in items" :key="item.id">
                                                <option :value="item.id" x-text="item.name"></option>
                                            </template>
                                        </select>
                                    </div>

                                    {{-- Deskripsi --}}
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                        <textarea readonly :value="items.find(i => i.id == selectedItem)?.description || '-'"
                                            x-text="items.find(i => i.id == selectedItem)?.description || '-'" rows="1"
                                            class="mt-1 w-full px-2 py-1.5 text-sm border border-gray-300 rounded-lg shadow-sm bg-gray-100 resize-y focus:ring focus:ring-indigo-200 focus:border-indigo-500 transition"></textarea>
                                    </div>
                                </div>

                                {{-- Kolom Kanan --}}
                                <div class="md:w-1/2 space-y-4 mt-4 md:mt-0">
                                    {{-- SKU --}}
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">SKU</label>
                                        <input type="text" readonly
                                            :value="items.find(i => i.id == selectedItem)?.sku || '-'"
                                            class="mt-1 w-full px-2 py-1.5 text-sm border border-gray-300 rounded-lg shadow-sm bg-gray-100 focus:ring focus:ring-indigo-200 focus:border-indigo-500 transition">
                                    </div>

                                    {{-- Stok Saat Ini --}}
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Stok Saat Ini</label>
                                        <input type="text" readonly
                                            :value="items.find(i => i.id == selectedItem)?.stock || '-'"
                                            class="mt-1 w-full px-2 py-1.5 text-sm border border-gray-300 rounded-lg shadow-sm bg-gray-100 focus:ring focus:ring-indigo-200 focus:border-indigo-500 transition">
                                    </div>
                                </div>
                            </div>

                            {{-- Nama Penerima --}}
                            <div x-data="{ selectedEmployee: '' }">
                                <label for="employee_id"
                                    class="block text-sm font-medium text-gray-700">Penerima</label>
                                <select name="employee_id" x-model="selectedEmployee" required
                                    class="mt-1 w-full px-2 py-1.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500 transition">
                                    <option value="">-- Pilih Penerima --</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Jumlah Barang Keluar --}}
                            <div>
                                <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah Barang
                                    Keluar</label>
                                <input type="number" name="quantity" min="1" required
                                    class="mt-1 w-full px-2 py-1.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500 transition">
                            </div>

                            {{-- Catatan --}}
                            <div>
                                <label for="note" class="block text-sm font-medium text-gray-700">Catatan
                                    (opsional)</label>
                                <textarea name="note" rows="2"
                                    class="mt-1 w-full px-2 py-1.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500 transition"></textarea>
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="flex justify-end gap-2 pt-4">
                                <button type="button" @click="open = false"
                                    class="px-4 py-2 text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg shadow cursor-pointer">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow cursor-pointer">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Form Search --}}
            <form method="GET" action="{{ route('dashboard.stockout.index') }}" class="w-full md:w-1/3 flex">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / SKU..."
                    autocomplete="off"
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
                        <th class="px-4 py-3 text-left whitespace-nowrap">Nama Barang</th>
                        <th class="px-4 py-3 text-left whitespace-nowrap">SKU</th>
                        <th class="px-4 py-3 text-center whitespace-nowrap">Jumlah Keluar</th>
                        <th class="px-4 py-3 text-left">Penerima</th>
                        <th class="px-4 py-3 text-left">Catatan</th>
                        <th class="px-4 py-3 text-center">Tanggal</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($stockOuts as $stockOut)
                        <tr class="hover:bg-blue-50">
                            <td class="px-4 py-2 text-center">
                                {{ $loop->iteration }}
                            </td>
                            <td class="px-4 py-2 font-medium whitespace-nowrap">
                                {{ Str::limit($stockOut->item->name, 25, '...') }}
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                {{ $stockOut->item->sku }}
                            </td>
                            <td class="px-4 py-2 text-center whitespace-nowrap">
                                {{ $stockOut->quantity }}
                            </td>
                            <td class="px-4 py-2 whitespace-nowrap">
                                {{ Str::limit($stockOut->employee->name, 25, '...') }}
                            </td>
                            <td class="px-4 py-2 break-words max-w-xs">
                                {{ $stockOut->note ?? '-' }}
                            </td>
                            <td class="px-4 py-2 text-center whitespace-nowrap">
                                {{ $stockOut->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="px-4 py-2 text-center">
                                <form action="{{ route('dashboard.stockout.destroy', $stockOut->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data barang keluar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:underline text-sm cursor-pointer">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500">Belum ada data barang keluar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $stockOuts->links('vendor.pagination.default') }}
        </div>
    </section>

</x-app-layout>
