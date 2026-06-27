<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['nama_paket', 'deskripsi', 'harga', 'status_aktif'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
