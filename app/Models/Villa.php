<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{
    protected $fillable = [
        'user_id', 'harga', 'nama_villa', 'deskripsi', 'gambar', 'status_villa'
    ];

    public function host()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
