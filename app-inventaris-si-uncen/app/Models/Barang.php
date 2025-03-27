<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $fillable = ['nama', 'kategori_id', 'keterangan'];

    public function kategori()
    {
        return $this->belongsTo(KategoriBarang::class, 'kategori_id', 'id');
    }
}