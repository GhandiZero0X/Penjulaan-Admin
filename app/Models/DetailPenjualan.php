<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $table = 'detail_penjualan';
    protected $primaryKey = 'iddetail_penjualan';
    public $timestamps = true;

    protected $fillable = [
        'harga_satuan',
        'jumlah',
        'subtotal',
        'penjualan_idpenjualan',
        'idbarang',
    ];

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_idpenjualan', 'idpenjualan');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'idbarang', 'idbarang');
    }
}
