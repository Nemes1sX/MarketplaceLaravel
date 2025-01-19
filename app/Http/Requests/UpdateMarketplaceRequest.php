<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMarketplaceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => ['required', 'string', 'max:255', 'unique:marketplaces,slug,' . $this->marketplace->id],
            'short_description' => ['nullable', 'string', 'max:255'],
        ];
    }
} 