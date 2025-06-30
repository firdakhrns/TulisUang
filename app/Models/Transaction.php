<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'user_id',
        'wallet_id',
        'category_id',
        'name',
        'amount',
        'type',
        'date',
        'note',
        'name',
    ];

    // Relasi ke pengguna (user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke dompet (wallet)
    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    // Relasi ke kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
