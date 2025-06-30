<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        // Validasi Input
        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        // Ambil data validasi search
        $search = $validated['search'] ?? null;

        // Query Pegawai
        $employees = Employee::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%");
            })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('dashboard.employees.create');
    }

    public function store(Request $request)
    {
        // Validasi Input
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'department' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
        ]);

        // Tambah data Pegawai
        Employee::create($validated);

        return redirect()->route('dashboard.employee.index')->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        // Ambil data Pegawai
        $employee = Employee::findOrFail($id);

        return view('dashboard.employees.edit', compact('employee'));
    }

    public function update(Request $request, string $id)
    {
        // Ambil data Pegawai
        $employee = Employee::findOrFail($id);

        // Validasi Input
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'gender' => 'required|in:Laki-Laki,Perempuan',
            'department' => 'required|in:Kepegawaian,Keuangan,IPDS',
            'phone' => 'required|string|max:20',
        ]);

        // Ubah data Pegawai
        $employee->update($validated);

        return redirect()->route('dashboard.employee.index')->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        // Ambil data Pegawai
        $employee = Employee::findOrFail($id);

        // Hapus data Pegawai
        $employee->delete();

        return redirect()->route('dashboard.employee.index')->with('success', 'Data pegawai berhasil dihapus.');
    }
}
