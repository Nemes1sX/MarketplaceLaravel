<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'marketplace_id',
        'image',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function marketplace()
    {
        return $this->belongsTo(Marketplace::class);
    }
}
