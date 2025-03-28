<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan';

    protected $fillable = ['nama', 'kategori_id', 'keterangan', 'gambar'];

    public function kategori()
    {
        return $this->belongsTo(KategoriRuangan::class, 'kategori_id', 'id');
    }
}