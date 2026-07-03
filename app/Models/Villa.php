<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{
    protected $fillable = [
        'user_id', 'harga', 'nama_villa', 'deskripsi', 'gambar', 'status_villa'
    ];

    // Accessor: returns correct public URL for both CI3 legacy paths and Laravel storage paths
    public function getGambarUrlAttribute(): string
    {
        if (!$this->gambar) {
            return asset('asset/background/gambarvilla.png');
        }

        // Legacy CI3 path: starts with "asset/" → already under public/
        if (str_starts_with($this->gambar, 'asset/')) {
            return asset($this->gambar);
        }

        // Laravel storage path (e.g. "uploads/abc.jpg")
        return asset('storage/' . $this->gambar);
    }

    public function host()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
