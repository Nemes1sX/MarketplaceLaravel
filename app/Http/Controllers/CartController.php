<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(
        private CartService $cartService
    ) {}

    public function index()
    {
        $cart = $this->cartService->getCart();
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Product $product)
    {
        $quantity = $request->input('quantity', 1);
        $this->cartService->addToCart($product, $quantity);
        
        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function remove(int $productId)
    {
        $this->cartService->removeFromCart($productId);
        
        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    public function update(Request $request, int $productId)
    {
        $quantity = $request->input('quantity');
        $this->cartService->updateQuantity($productId, $quantity);
        
        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function applyDiscount(Request $request)
    {
        $request->validate([
            'discount_code' => 'required|string|max:50'
        ]);
        
        $this->cartService->applyDiscountCode($request->input('discount_code'));
        
        return redirect()->back()->with('success', 'Discount code applied!');
    }

    public function clear()
    {
        $this->cartService->clear();
        
        return redirect()->back()->with('success', 'Cart cleared!');
    }
} 