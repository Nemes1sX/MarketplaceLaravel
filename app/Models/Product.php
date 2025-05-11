<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'marketplace_id',
        'image',
        'price',
    ];


    protected function price() : Attribute
    {
        return Attribute::make(
            get: fn (int $value) => $value / 100,
            set: fn (int $value) => $value * 100
        );
    }

    protected function slug() : Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Str::of($value)->slug('-')
        );
    }

    public function marketplace()
    {
        return $this->belongsTo(Marketplace::class);
    }
}
