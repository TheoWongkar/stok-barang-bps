<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Item;
use App\Models\StockIn;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StockInController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $search = $validated['search'] ?? null;

        $stockIns = StockIn::with('item')
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

        return view('dashboard.stockins.index', compact('stockIns', 'items'));
    }

    public function store(Request $request)
    {
        // Validasi Input
        $validated = $request->validate([
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        // Simpan data barang masuk
        $stockIn = StockIn::create($validated);

        // Tambahkan stok ke item terkait
        $item = Item::findOrFail($validated['item_id']);
        $item->increment('stock', $validated['quantity']);

        return redirect()->route('dashboard.stockin.index')->with('success', 'Barang masuk berhasil disimpan dan stok ditambahkan.');
    }

    public function destroy(string $id)
    {
        // Ambil data Barang Masuk
        $stockIn = StockIn::findOrFail($id);

        // Kurangi stock
        $item = $stockIn->item;
        if ($item && $item->stock >= $stockIn->quantity) {
            $item->decrement('stock', $stockIn->quantity);
        }

        // Hapus record Barang Masuk
        $stockIn->delete();

        return redirect()->route('dashboard.stockin.index')->with('success', 'Data berhasil dihapus.');
    }
}
