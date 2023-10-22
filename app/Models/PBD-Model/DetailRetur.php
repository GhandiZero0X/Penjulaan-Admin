<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRetur extends Model
{
    use HasFactory;

    protected $table = 'detail_retur';
    protected $primaryKey = 'iddetail_retur';
    public $timestamps = true;

    protected $fillable = [
        'jumlah',
        'alasan',
        'idretur',
        'iddetail_penerimaan',
    ];

    public function retur()
    {
        return $this->belongsTo(Retur::class, 'idretur', 'idretur');
    }

    public function detailPenerimaan()
    {
        return $this->belongsTo(DetailPenerimaan::class, 'iddetail_penerimaan', 'iddetail_pengadaan');
    }
}
