<x-app-layout>

    {{-- Judul Halaman --}}
    <x-slot name="title">Tambah Data Barang</x-slot>

    {{-- Bagian Tambah Data Barang --}}
    <section class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Form Tambah Data Barang</h2>

        <form method="POST" action="{{ route('dashboard.item.store') }}" class="space-y-5">
            @csrf

            {{-- Nama Barang --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required
                    class="mt-1 w-full px-2 py-1.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500 transition">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea id="description" name="description" required rows="2"
                    class="mt-1 w-full px-2 py-1.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500 transition">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-3">
                {{-- SKU --}}
                <div>
                    <label for="sku" class="block text-sm font-medium text-gray-700">SKU</label>
                    <div
                        class="mt-1 flex rounded-lg border border-gray-300 shadow-sm focus-within:ring focus-within:ring-indigo-200 focus-within:border-indigo-500 transition">
                        <span
                            class="inline-flex items-center px-3 text-sm text-gray-500 bg-gray-100 border-r border-gray-300 rounded-l-lg">
                            SKU-
                        </span>
                        <input id="sku" name="sku" type="number" value="{{ old('sku') }}"
                            class="w-full px-2 py-1.5 text-sm text-gray-900 rounded-r-lg border-none focus:outline-none" />
                    </div>

                    @error('sku')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Stok --}}
                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stok Awal</label>
                    <div class="mt-1">
                        <input id="stock" name="stock" type="number" value="{{ old('stock') }}" required
                            min="0"
                            class="w-full px-2 py-1.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500 transition" />
                    </div>
                    @error('stock')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('dashboard.item.index') }}"
                    class="px-4 py-2 text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg shadow">Batal</a>
                <button type="submit"
                    class="px-4 py-2 text-sm bg-green-600 hover:bg-green-700 text-white rounded-lg shadow cursor-pointer">Simpan</button>
            </div>
        </form>
    </section>

</x-app-layout>
