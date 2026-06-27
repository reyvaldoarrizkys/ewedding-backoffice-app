<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $fillable = ['tipe_info', 'judul', 'konten_teks', 'url_media'];
}
