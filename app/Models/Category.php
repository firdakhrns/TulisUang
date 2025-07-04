<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'type'
    ];
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function user(){
        return $this->belongsTo(user::class);
    }
}