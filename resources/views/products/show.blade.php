<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $product->name }}
            </h2>
            <a href="{{ route('marketplaces.products.index', $marketplace) }}" 
               class="text-blue-500 hover:text-blue-700">
                ← Back to Products
            </a>
        </div>
    </x-slot>

    <div class="py-16">
        <div class="max-w-7xl mx-auto sm:px-8 lg:px-12">
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <div class="p-8">
                    @if(session()->flash('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Holy smokes!</strong>
                        <span class="block sm:inline">{{session()->flash('success')}}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                          <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                      </div>
                     @endif
                    <div class="grid grid-cols-2 md:grid-cols-2 gap-2">
                        <!-- Product Image -->
                        <div class="relative col-span-1">
                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" 
                                     alt="{{ $product->name }}"
                                     class="w-full h-[500px] object-cover rounded-lg">
                            @else
                                <div class="w-full h-96 bg-gray-100 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-400">No image available</span>
                                </div>
                            @endif
                        </div>

                        <!-- Product Details -->
                        <div class="space-y-8 col-span-1">
                            <div>
                                <h3 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h3>
                                <p class="mt-4 text-4xl font-bold text-blue-600">
                                    ${{ number_format($product->price, 2) }}
                                </p>
                            </div>

                            <div>
                                <h4 class="text-xl font-semibold text-gray-900">Description</h4>
                                <p class="mt-4 text-gray-600">{{ $product->description }}</p>
                            </div>

                            <div>
                                <h4 class="text-xl font-semibold text-gray-900">Details</h4>
                                <dl class="mt-4 space-y-4">
                                    <div class="flex justify-between">
                                        <dt class="text-gray-600">SKU</dt>
                                        <dd class="text-gray-900">{{ $product->sku ?? 'N/A' }}</dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-gray-600">Stock</dt>
                                        <dd class="text-gray-900">{{ $product->stock ?? 'N/A' }}</dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-gray-600">Category</dt>
                                        <dd class="text-gray-900">{{ $product->category ?? 'N/A' }}</dd>
                                    </div>
                                </dl>
                            </div>

                            <!-- Add to Cart Button -->
                            <div class="mt-8">
                                <form action="{{ route('cart.add', $product) }}" method="POST">
                                    @csrf
                                    <div class="flex items-center space-x-4">
                                        <input type="number" 
                                               name="quantity" 
                                               value="1" 
                                               min="1" 
                                               class="w-20 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                        <button type="submit" 
                                                class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-lg text-lg">
                                            Add to Cart
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 