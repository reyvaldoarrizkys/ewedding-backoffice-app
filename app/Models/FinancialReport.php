<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialReport extends Model
{
    protected $fillable = ['jenis_transaksi', 'deskripsi', 'jumlah', 'tanggal_transaksi', 'order_id'];

    protected function casts(): array
    {
        return [
            'tanggal_transaksi' => 'date',
        ];
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
