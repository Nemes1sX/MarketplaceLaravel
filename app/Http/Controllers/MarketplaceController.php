<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marketplace;
use App\Http\Requests\MarketplaceRequest;
use App\Http\Resources\MarketplaceResource;

class MarketplaceController extends Controller
{
    

    public function index()
    {
        $marketplaces = Marketplace::all();
        return MarketplaceResource::collection($marketplaces);
    }

    public function show(Marketplace $marketplace)
    {
        return new MarketplaceResource($marketplace);
    }

    public function store(MarketplaceRequest $request)
    {
        $marketplace = Marketplace::create($request->validated());
        return new MarketplaceResource($marketplace);
    }

    public function update(MarketplaceRequest $request, Marketplace $marketplace)
    {
        $marketplace->update($request->validated());
        return new MarketplaceResource($marketplace);
    }

    public function destroy(Marketplace $marketplace)
    {
        $marketplace->delete();
        return response()->json(null, 204);
    }
}
