<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marketplace extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'image',
        'user_id',
        'slug',
        'short_description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
