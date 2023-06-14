<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'id_produk',
            'nama_produk',
            'harga',
            'kategori',
            'status',

        ];
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $guarded = [];
}