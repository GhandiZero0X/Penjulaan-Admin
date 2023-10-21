<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'role'; // Menyamakan nama tabel dengan yang ada di migrasi
    protected $primaryKey = 'idrole'; // Menyamakan nama kolom primary key dengan yang ada di migrasi
    protected $fillable = ['nama_role']; // Kolom yang dapat diisi
    public $timestamps = true; // Nonaktifkan kolom created_at dan updated_at
}
