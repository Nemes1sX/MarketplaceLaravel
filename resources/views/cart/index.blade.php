@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-black dark:text-white mb-6">Your Cart</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cart->items) > 0)
        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-lg overflow-hidden mb-6">
            <table class="w-full">
                <thead class="bg-gray-100 dark:bg-zinc-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-zinc-700">
                    @foreach($cart->items as $item)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="h-10 w-10 flex-shrink-0">
                                    <img class="h-10 w-10 rounded-md object-cover" src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $item['name'] }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $item['marketplace'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-white">${{ number_format($item['price'], 2) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('cart.update', $item['product_id']) }}" method="POST" class="flex items-center">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-16 rounded-md border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                                <button type="submit" class="ml-2 text-sm text-[#FF2D20] hover:text-[#FF2D20]/80">Update</button>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 dark:text-white">${{ number_format($item['price'] * $item['quantity'], 2) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-[#FF2D20] hover:text-[#FF2D20]/80">Remove</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50 dark:bg-zinc-800">
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-right font-medium text-gray-900 dark:text-white">Subtotal:</td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">${{ number_format($cart->getTotal(), 2) }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="flex flex-col md:flex-row gap-6 mb-6">
            <div class="w-full md:w-1/2 bg-white dark:bg-zinc-900 rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-black dark:text-white mb-4">Discount Code</h2>
                <form action="{{ route('cart.discount') }}" method="POST" class="flex">
                    @csrf
                    <input type="text" name="discount_code" value="{{ $cart->discountCode }}" placeholder="Enter discount code" 
                           class="flex-1 rounded-l-md border-gray-300 dark:border-zinc-700 dark:bg-zinc-800 dark:text-white">
                    <button type="submit" class="bg-[#FF2D20] text-white px-4 py-2 rounded-r-md hover:bg-[#FF2D20]/90 transition">Apply</button>
                </form>
            </div>
            
            <div class="w-full md:w-1/2 bg-white dark:bg-zinc-900 rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold text-black dark:text-white mb-4">Order Summary</h2>
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600 dark:text-gray-400">Subtotal</span>
                    <span class="text-black dark:text-white">${{ number_format($cart->getTotal(), 2) }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600 dark:text-gray-400">Discount</span>
                    <span class="text-black dark:text-white">$0.00</span>
                </div>
                <div class="border-t border-gray-200 dark:border-zinc-700 my-2 pt-2">
                    <div class="flex justify-between font-semibold">
                        <span class="text-black dark:text-white">Total</span>
                        <span class="text-[#FF2D20]">${{ number_format($cart->getTotal(), 2) }}</span>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="#" class="block w-full text-center bg-[#FF2D20] text-white py-2 px-4 rounded-md hover:bg-[#FF2D20]/90 transition">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center">
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                <button type="submit" class="text-[#FF2D20] hover:text-[#FF2D20]/80">Clear Cart</button>
            </form>
        </div>
    @else
        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-lg p-8 text-center">
            <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">Your cart is empty</p>
            <a href="{{ route('home') }}" class="inline-block bg-[#FF2D20] text-white py-2 px-6 rounded-md hover:bg-[#FF2D20]/90 transition">
                Continue Shopping
            </a>
        </div>
    @endif
</div>
@endsection 