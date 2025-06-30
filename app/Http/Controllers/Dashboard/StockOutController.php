<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Item;
use App\Models\Employee;
use App\Models\StockOut;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockOutController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $search = $validated['search'] ?? null;

        $stockOuts = StockOut::with('item')
            ->when($search, function ($query, $search) {
                $query->whereHas('item', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('sku', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $items = Item::orderBy('name')->get();

        $employees = Employee::orderBy('name')->get();

        return view('dashboard.stockouts.index', compact('stockOuts', 'items', 'employees'));
    }

    public function store(Request $request)
    {
        // Validasi Input
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'employee_id' => 'required|exists:employees,id',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        // Ambil data item
        $item = Item::findOrFail($validated['item_id']);

        // Cek apakah stok mencukupi
        if ($validated['quantity'] > $item->stock) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi untuk jumlah yang diminta.');
        }

        // Simpan data barang keluar
        StockOut::create($validated);

        // Kurangi stok ke item terkait
        $item->decrement('stock', $validated['quantity']);


        return redirect()->route('dashboard.stockout.index')->with('success', 'Barang berhasil dikeluarkan.');
    }

    public function destroy(string $id)
    {
        // Ambil data Barang Keluar
        $stockOut = StockOut::findOrFail($id);

        // Tambah kembali stok barang
        $item = $stockOut->item;
        if ($item) {
            $item->increment('stock', $stockOut->quantity);
        }

        // Hapus record Barang Keluar
        $stockOut->delete();

        return redirect()->route('dashboard.stockout.index')->with('success', 'Data berhasil dihapus.');
    }
}
