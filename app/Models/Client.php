<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['nama_klien', 'alamat', 'telepon', 'email'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
