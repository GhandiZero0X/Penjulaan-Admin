<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenerimaan extends Model
{
    use HasFactory;

    protected $table = 'detail_penerimaan';
    protected $primaryKey = 'iddetail_penerimaan';
    public $timestamps = true;

    protected $fillable = [
        'harga_satuan',
        'jumlah',
        'sub_total',
        'idbarang',
        'idpengadaan',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'idbarang', 'idbarang');
    }

    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class, 'idpengadaan', 'idpengadaan');
    }
}
