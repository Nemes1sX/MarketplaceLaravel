<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-6">
                    @if($marketplace->image)
                        <img src="{{ Storage::url($marketplace->image) }}" 
                             alt="{{ $marketplace->title }}"
                             class="w-full h-96 object-cover rounded-lg mb-6">
                    @endif

                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-800">{{ $marketplace->title }}</h1>
                            <p class="text-gray-500 mt-2">Posted by {{ $marketplace->user->name }}</p>
                        </div>
                        <div class="text-2xl font-bold text-green-600">
                            ${{ number_format($marketplace->price, 2) }}
                        </div>
                    </div>

                    <div class="mt-6">
                        <h2 class="text-xl font-semibold text-gray-800">Description</h2>
                        <p class="mt-2 text-gray-600">{{ $marketplace->description }}</p>
                    </div>

                    <div class="mt-6 flex items-center gap-4">
                        <span class="px-3 py-1 bg-gray-100 rounded-full text-gray-600">
                            {{ $marketplace->category }}
                        </span>
                        <span class="text-gray-500">
                            <i class="fas fa-map-marker-alt"></i> {{ $marketplace->location }}
                        </span>
                    </div>

                    @if(Auth::id() === $marketplace->user_id)
                        <div class="mt-8 flex gap-4">
                            <a href="{{ route('marketplaces.edit', $marketplace) }}" 
                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit Listing
                            </a>
                            <form action="{{ route('marketplaces.destroy', $marketplace) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this listing?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Delete Listing
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 