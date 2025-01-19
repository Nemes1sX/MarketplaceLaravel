<?php

namespace App\Http\Controllers;

use App\Models\Marketplace;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MarketplaceRequest;   

class MarketplaceController extends Controller
{
    public function index()
    {
        $marketplaces = Marketplace::with('user')
            ->where('status', 'active')
            ->latest()
            ->paginate(12);
            
        return view('marketplaces.index', compact('marketplaces'));
    }

    public function create()
    {
        return view('marketplaces.create');
    }

    public function store(MarketplaceRequest $request)
    {    
        $validated = $request->validated();
        
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('marketplace-images', 'public');
        }

        auth()->user()->marketplace()->create($validated); 

        return redirect()->route('marketplaces.index')
            ->with('success', 'Marketplace created successfully.');
    }

    public function show(Marketplace $marketplace)
    {
        return view('marketplaces.show', compact('marketplace'));
    }

    public function edit(Marketplace $marketplace)
    {
        return view('marketplaces.edit', compact('marketplace'));
    }

    public function update(MarketplaceRequest $request, Marketplace $marketplace)
    {
    
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('marketplace-images', 'public');
        }

        $marketplace->update($validated);

        return redirect()->route('marketplaces.show', $marketplace)
            ->with('success', 'Marketplace updated successfully.');
    }

    public function destroy(Marketplace $marketplace)
    {
        $marketplace->delete();

        return redirect()->route('marketplaces.index')
            ->with('success', 'Marketplace deleted successfully.');
    }
}
