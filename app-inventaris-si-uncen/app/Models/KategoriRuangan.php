<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriRuangan extends Model
{
    use HasFactory;

    protected $table = 'kategori_ruangan';

    protected $guarded = [];

    public function ruangan()
    {
        return $this->hasMany(Ruangan::class, 'kategori_id', 'id');
    }
}
