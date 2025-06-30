<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'stock',
        'unit'
    ];

    // Relasi: 1 item punya banyak stok masuk
    public function stockIns()
    {
        return $this->hasMany(StockIn::class);
    }

    // Relasi: 1 item punya banyak stok keluar
    public function stockOuts()
    {
        return $this->hasMany(StockOut::class);
    }
}
