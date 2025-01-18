<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Marketplace Listings</h2>
                @auth
                    <a href="{{ route('marketplaces.create') }}" 
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Create New Listing
                    </a>
                @endauth
            </div>

            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($marketplaces as $marketplace)
                    <div class="bg-white overflow-hidden shadow-sm rounded-lg hover:shadow-md transition-shadow">
                        <a href="{{ route('marketplaces.show', $marketplace) }}" class="block">
                            @if($marketplace->image)
                                <img src="{{ Storage::url($marketplace->image) }}" 
                                     alt="{{ $marketplace->name }}"
                                     class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-100 flex items-center justify-center">
                                    <span class="text-gray-400">No image</span>
                                </div>
                            @endif
                            
                            <div class="p-4">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-lg font-semibold text-gray-800">{{ $marketplace->name }}</h3>
                                    <span class="px-2 py-1 text-sm {{ $marketplace->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} rounded-full">
                                        {{ ucfirst($marketplace->status) }}
                                    </span>
                                </div>
                                
                                <p class="mt-2 text-gray-600 text-sm line-clamp-2">
                                    {{ $marketplace->description }}
                                </p>
                                
                                <div class="mt-4 text-sm text-gray-500">
                                    Posted by {{ $marketplace->user->name }}
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        No listings found.
                    </div>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $marketplaces->links() }}
            </div>
        </div>
    </div>
</x-app-layout> 