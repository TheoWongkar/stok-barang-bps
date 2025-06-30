<x-app-layout>

    {{-- Judul Halaman --}}
    <x-slot name="title">Tambah Data Pegawai</x-slot>

    {{-- Bagian Tambah Data Pegawai --}}
    <section class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Form Tambah Data Pegawai</h2>

        <form method="POST" action="{{ route('dashboard.employee.store') }}" class="space-y-5">
            @csrf

            {{-- Nama --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required
                    class="mt-1 w-full px-2 py-1.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500 transition">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Jenis Kelamin --}}
            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select name="gender" id="gender" required
                    class="mt-1 w-full px-2 py-1.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500 transition">
                    <option value="">-- Pilih --</option>
                    <option value="Laki-Laki" {{ old('gender') === 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="Perempuan" {{ old('gender') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('gender')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Departemen --}}
            <div>
                <label for="department" class="block text-sm font-medium text-gray-700">Departemen</label>
                <select name="department" id="department" required
                    class="mt-1 w-full px-2 py-1.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500 transition">
                    <option value="">-- Pilih --</option>
                    <option value="Kepegawaian" {{ old('department') === 'Kepegawaian' ? 'selected' : '' }}>Kepegawaian
                    </option>
                    <option value="Keuangan" {{ old('department') === 'Keuangan' ? 'selected' : '' }}>Keuangan</option>
                    <option value="IPDS" {{ old('department') === 'IPDS' ? 'selected' : '' }}>IPDS</option>
                </select>
                @error('department')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Telepon --}}
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Telepon</label>
                <input id="phone" name="phone" type="number" value="{{ old('phone') }}" required
                    class="mt-1 w-full px-2 py-1.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500 transition">
                @error('phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('dashboard.employee.index') }}"
                    class="px-4 py-2 text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg shadow">Batal</a>
                <button type="submit"
                    class="px-4 py-2 text-sm bg-green-600 hover:bg-green-700 text-white rounded-lg shadow cursor-pointer">Simpan</button>
            </div>
        </form>
    </section>

</x-app-layout>
