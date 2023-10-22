<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $primaryKey = 'idbarang';
    protected $fillable = ['jenis', 'nama', 'idsatuan', 'status', 'harga'];
    public $timestamps = true;


    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'idsatuan', 'idsatuan');
    }
}
