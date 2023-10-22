<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuStok extends Model
{
    use HasFactory;

    protected $table = 'kartu_stok';
    protected $primaryKey = 'idkartu_stok';
    public $timestamps = true;

    protected $fillable = [
        'jenis_transaksi',
        'masuk',
        'keluar',
        'stock',
        'idtransaksi',
        'idbarang',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'idbarang', 'idbarang');
    }
}
