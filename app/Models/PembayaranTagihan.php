<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranTagihan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tagihan()
    {
        return $this->belongsTo(TagihanBulanan::class, 'tagihan_id', 'id');
    }
}
