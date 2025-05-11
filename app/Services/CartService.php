<?php

namespace App\Services;

use App\DTOs\CartDTO;
use App\Models\Product;
use Illuminate\Session\SessionManager;

class CartService
{
    private const CART_KEY = 'cart';

    public function __construct(
        private SessionManager $session
    ) {}

    public function getCart(): CartDTO
    {
        $cartData = $this->session->get(self::CART_KEY, []);
        return CartDTO::fromSession($cartData);
    }

    public function saveCart(CartDTO $cart): void
    {
        $this->session->put(self::CART_KEY, $cart->toArray());
    }

    public function addToCart(Product $product, int $quantity = 1): void
    {
        $cart = $this->getCart();
        
        $cart->addItem([
            'product_id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $quantity,
            'image' => $product->image,
            'marketplace' => $product->marketplace->name
        ]);
        
        $this->saveCart($cart);
    }

    public function removeFromCart(int $productId): void
    {
        $cart = $this->getCart();
        $cart->removeItem($productId);
        $this->saveCart($cart);
    }

    public function updateQuantity(int $productId, int $quantity): void
    {
        $cart = $this->getCart();
        $cart->updateItemQuantity($productId, $quantity);
        $this->saveCart($cart);
    }

    public function applyDiscountCode(string $code): void
    {
        $cart = $this->getCart();
        $cart->discountCode = $code;
        $this->saveCart($cart);
    }

    public function setOrderId(string $orderId): void
    {
        $cart = $this->getCart();
        $cart->orderId = $orderId;
        $this->saveCart($cart);
    }

    public function clear(): void
    {
        $this->session->forget(self::CART_KEY);
    }
} 