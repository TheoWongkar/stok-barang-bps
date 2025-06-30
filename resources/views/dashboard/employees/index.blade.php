<x-app-layout>

    {{-- Judul Halaman --}}
    <x-slot name="title">Data Pegawai</x-slot>

    {{-- Bagian Data Pegawai --}}
    <section>
        {{-- Header: Tombol Tambah & Search --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            {{-- Tombol Tambah Pegawai --}}
            <a href="{{ route('dashboard.employee.create') }}"
                class="w-full md:w-auto px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow text-center">
                Tambah Pegawai
            </a>

            {{-- Form Search --}}
            <form method="GET" action="{{ route('dashboard.employee.index') }}" class="w-full md:w-1/3 flex">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama / departemen..."
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
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-center">Jenis Kelamin</th>
                        <th class="px-4 py-3 text-left">Departemen</th>
                        <th class="px-4 py-3 text-left">Telepon</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($employees as $employee)
                        <tr class="hover:bg-blue-50">
                            <td class="px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2 font-medium">{{ Str::limit($employee->name, 25, '...') }}</td>
                            <td class="px-4 py-2 text-center">
                                @if ($employee->gender === 'Laki-Laki')
                                    <span
                                        class="inline-block px-2 py-1 text-xs font-semibold text-blue-700 bg-blue-200 border border-blue-400 rounded-full">
                                        Laki-Laki
                                    </span>
                                @elseif ($employee->gender === 'Perempuan')
                                    <span
                                        class="inline-block px-2 py-1 text-xs font-semibold text-pink-700 bg-pink-200 border border-pink-400 rounded-full">
                                        Perempuan
                                    </span>
                                @else
                                    <span
                                        class="inline-block px-2 py-1 text-xs font-semibold text-gray-700 bg-gray-200 border border-gray-400 rounded-full">
                                        -
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $employee->department }}</td>
                            <td class="px-4 py-2">{{ $employee->phone }}</td>
                            <td class="px-4 py-2 space-x-2 text-center">
                                <a href="{{ route('dashboard.employee.edit', $employee->id) }}"
                                    class="text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('dashboard.employee.destroy', $employee->id) }}" method="POST"
                                    class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 cursor-pointer hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-4 text-center text-gray-500">Data pegawai belum tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $employees->links('vendor.pagination.default') }}
        </div>
    </section>

</x-app-layout>
