<?php

namespace App\Http\Controllers;

use App\Models\Marketplace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MarketplaceRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MarketplaceController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index()
    {
        $marketplaces = Marketplace::latest()->paginate(10);
        return view('marketplaces.index', compact('marketplaces'));
    }

    public function create()
    {
        return view('marketplaces.create');
    }

    public function store(MarketplaceRequest $request)
    {
        $validated = $request->validated();
        
        $marketplace = new Marketplace($validated);
        $marketplace->user_id = Auth::id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('marketplace-images', 'public');
            $marketplace->image = $path;
        }

        $marketplace->save();

        return redirect()->route('marketplaces.show', $marketplace)
            ->with('success', 'Listing created successfully!');
    }

    public function show(Marketplace $marketplace)
    {
        return view('marketplaces.show', compact('marketplace'));
    }

    public function edit(Marketplace $marketplace)
    {
        $this->authorize('update', $marketplace);
        return view('marketplaces.edit', compact('marketplace'));
    }

    public function update(MarketplaceRequest $request, Marketplace $marketplace)
    {
        $this->authorize('update', $marketplace);
        
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('marketplace-images', 'public');
            $validated['image'] = $path;
        }

        $marketplace->update($validated);

        return redirect()->route('marketplaces.show', $marketplace)
            ->with('success', 'Listing updated successfully!');
    }

    public function destroy(Marketplace $marketplace)
    {
        $this->authorize('delete', $marketplace);
        $marketplace->delete();

        return redirect()->route('marketplaces.index')
            ->with('success', 'Listing deleted successfully!');
    }
}
