<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarginPenjualan extends Model
{
    use HasFactory;

    protected $table = 'margin_penjualan';
    protected $primaryKey = 'idmargin_penjualan';
    public $timestamps = false;

    protected $fillable = [
        'persen',
        'status',
        'iduser',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'iduser');
    }
}
