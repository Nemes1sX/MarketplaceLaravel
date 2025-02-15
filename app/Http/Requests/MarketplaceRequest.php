<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\OnlyMarketplaceRule;
class MarketplaceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:marketplaces,name' . ($this->marketplace ? ',' . $this->marketplace->id : ''),  new OnlyMarketplaceRule()],
            'description' => ['required', 'string'],
            'status' => ['required', 'in:active,inactive'],
            'slug' => ['required', 'string', 'max:255', 'unique:marketplaces,slug,' . ($this->marketplace?->id ?? '')],
            'short_description' => ['nullable', 'string', 'max:255'],
            // Add other validation rules based on your marketplace fields
        ];
    }
} 