<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['client_id', 'package_id', 'user_id', 'biaya_tambahan', 'keterangan_tambahan', 'tanggal_pesan', 'tanggal_acara', 'total_harga', 'status_pesanan', 'status_pembayaran'];

    protected function casts(): array
    {
        return [
            'tanggal_pesan' => 'datetime',
            'tanggal_acara' => 'date',
        ];
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function financialReport()
    {
        return $this->hasOne(FinancialReport::class);
    }
}
