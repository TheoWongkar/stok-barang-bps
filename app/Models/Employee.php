<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'department',
        'phone',
    ];

    // Relasi: 1 employee bisa punya banyak pengeluaran stok
    public function stockOuts()
    {
        return $this->hasMany(StockOut::class);
    }
}
