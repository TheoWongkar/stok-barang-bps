<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    /** @use HasFactory<\Database\Factories\StockInFactory> */
    use HasFactory;

    protected $fillable = [
        'item_id',
        'quantity',
        'note',
    ];

    // Relasi: stok keluar ini milik satu item
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
