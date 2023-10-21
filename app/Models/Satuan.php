<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;
    protected $table = 'satuan'; // Menyamakan nama tabel dengan yang ada di migrasi
    protected $primaryKey = 'idsatuan'; // Menyamakan nama kolom primary key dengan yang ada di migrasi
    protected $fillable = ['nama_satuan', 'status']; // Kolom yang dapat diisi
    public $timestamps = true; // Aktifkan kolom created_at dan updated_at
}
