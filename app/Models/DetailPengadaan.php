<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengadaan extends Model
{
    use HasFactory;
    protected $table = 'detail_pengadaan';
    protected $primaryKey = 'iddetail_pengadaan';
    protected $fillable = [
        'harga_satuan',
        'jumlah',
        'sub_total',
        'idbarang',
        'idpengadaan',
    ];
    public $timestamps = true;

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'idbarang', 'idbarang');
    }

    public function pengadaan()
    {
        return $this->belongsTo(Pengadaan::class, 'idpengadaan', 'idpengadaan');
    }
}
