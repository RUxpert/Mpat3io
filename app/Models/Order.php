<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'tenant_id', 'villa_id', 'host_id', 'total_harga', 
        'tgl_check_in', 'tgl_check_out', 'tgl_pesanan', 'status_pesanan'
    ];

    public function tenant()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    public function host()
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    public function villa()
    {
        return $this->belongsTo(Villa::class);
    }
}
