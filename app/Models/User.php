<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $table = 'user'; // Menyamakan nama tabel dengan yang ada di migrasi
    protected $primaryKey = 'iduser'; // Menyamakan nama kolom primary key dengan yang ada di migrasi
    protected $fillable = ['username', 'password', 'idrole']; // Kolom yang dapat diisi
    public $timestamps = true; // Aktifkan kolom created_at dan updated_at

    public function role()
    {
        return $this->belongsTo(Role::class, 'idrole', 'idrole');
    }
}
