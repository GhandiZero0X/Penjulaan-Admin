<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $table = 'vendor'; // Menyamakan nama tabel dengan yang ada di migrasi
    protected $primaryKey = 'idvendor'; // Menyamakan nama kolom primary key dengan yang ada di migrasi
    protected $fillable = ['nama_vendor', 'badan_hukum', 'status']; // Kolom yang dapat diisi
    public $timestamps = true; // Aktifkan kolom created_at dan updated_at
}
