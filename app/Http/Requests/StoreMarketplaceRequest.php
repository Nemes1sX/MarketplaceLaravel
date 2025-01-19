<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMarketplaceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => ['required', 'string', 'max:255', 'unique:marketplaces'],
            'short_description' => ['nullable', 'string', 'max:255'],
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
} 