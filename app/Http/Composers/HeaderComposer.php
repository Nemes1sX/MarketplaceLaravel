<?php 

namespace App\Http\Composers;

use App\Services\CartService;
use Illuminate\Contracts\View\View;

class HeaderComposer 
{
    protected CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function compose(View $view): void
    {
        $cart = $this->cartService->getCart();
        
        $view->with([
            'cartCount' => $cart->totalQuantity ?? 0,
            'cartTotal' => $cart->totalPrice ?? 0
        ]);
    }
}