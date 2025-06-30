<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        // Validasi input search
        $validated = $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $search = $validated['search'] ?? null;

        // Query data items
        $items = Item::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('sku', 'like', "%{$search}%");
        })
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('dashboard.items.index', compact('items'));
    }

    public function create()
    {
        return view('dashboard.items.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'sku' => [
                'required',
                'numeric',
                'digits_between:1,10',
                function ($attribute, $value, $fail) {
                    // Format SKU menjadi SKU-XXX
                    $formattedSku = 'SKU-' . ltrim($value, '0');

                    // Cek apakah SKU sudah ada di database
                    if (Item::where('sku', $formattedSku)->exists()) {
                        $fail("{$formattedSku} sudah terdaftar.");
                    }
                },
            ],
            'stock' => 'required|integer|min:0',
        ]);

        // Format ulang SKU
        $formattedSku = 'SKU-' . ltrim($validated['sku'], '0');
        $validated['sku'] = $formattedSku;

        // Tambah data Barang
        Item::create($validated);

        return redirect()->route('dashboard.item.index')->with('success', 'Data barang berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        // Ambil data Barang
        $item = Item::findOrFail($id);

        return view('dashboard.items.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        // Ambil data Barang
        $item = Item::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'sku' => [
                'required',
                'numeric',
                'digits_between:1,10',
                function ($attribute, $value, $fail) use ($item) {
                    // Format SKU menjadi SKU-XXX
                    $formattedSku = 'SKU-' . ltrim($value, '0');

                    // Cek apakah SKU sudah dipakai oleh item lain
                    if (Item::where('sku', $formattedSku)->where('id', '!=', $item->id)->exists()) {
                        $fail("{$formattedSku} sudah terdaftar.");
                    }
                },
            ],
            'stock' => 'required|integer|min:0',
        ]);

        // Format ulang SKU
        $formattedSku = 'SKU-' . ltrim($validated['sku'], '0');
        $validated['sku'] = $formattedSku;

        // Ubah data Barang
        $item->update($validated);

        return redirect()->route('dashboard.item.index')->with('success', 'Data barang berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        // Ambil data Barang
        $item = Item::findOrFail($id);

        // Hapus data Barang
        $item->delete();

        return redirect()->route('dashboard.item.index')->with('success', 'Data barang berhasil dihapus.');
    }
}
