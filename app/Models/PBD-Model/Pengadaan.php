<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengadaan extends Model
{
    use HasFactory;
    protected $table = 'pengadaan'; // Menyamakan nama tabel dengan yang ada di migrasi
    protected $primaryKey = 'idpengadaan'; // Menyamakan nama kolom primary key dengan yang ada di migrasi
    protected $fillable = [
        'timestamp',
        'user_iduser',
        'status',
        'vendor_idvendor',
        'subtotal_nilai',
        'ppn',
        'total_nilai'
    ];
    public $timestamps = true; // Aktifkan kolom created_at dan updated_at

    public function user()
    {
        return $this->belongsTo(User::class, 'user_iduser', 'iduser');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_idvendor', 'idvendor');
    }
}
