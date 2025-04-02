<?php

namespace App\DTOs;

class CartDTO
{
    public function __construct(
        public array $items = [],
        public ?string $discountCode = null,
        public ?string $orderId = null
    ) {}

    public static function fromSession(array $sessionData): self
    {
        return new self(
            items: $sessionData['items'] ?? [],
            discountCode: $sessionData['discount_code'] ?? null,
            orderId: $sessionData['order_id'] ?? null
        );
    }

    public function toArray(): array
    {
        return [
            'items' => $this->items,
            'discount_code' => $this->discountCode,
            'order_id' => $this->orderId
        ];
    }

    public function addItem(array $item): void
    {
        $existingItemIndex = $this->findItemIndex($item['product_id']);
        
        if ($existingItemIndex !== false) {
            $this->items[$existingItemIndex]['quantity'] += $item['quantity'];
        } else {
            $this->items[] = $item;
        }
    }

    public function removeItem(int $productId): void
    {
        $itemIndex = $this->findItemIndex($productId);
        
        if ($itemIndex !== false) {
            array_splice($this->items, $itemIndex, 1);
        }
    }

    public function updateItemQuantity(int $productId, int $quantity): void
    {
        $itemIndex = $this->findItemIndex($productId);
        
        if ($itemIndex !== false) {
            $this->items[$itemIndex]['quantity'] = $quantity;
        }
    }

    public function getTotal(): float
    {
        return array_reduce($this->items, function ($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);
    }

    public function getItemCount(): int
    {
        return array_reduce($this->items, function ($count, $item) {
            return $count + $item['quantity'];
        }, 0);
    }

    private function findItemIndex(int $productId)
    {
        foreach ($this->items as $index => $item) {
            if ($item['product_id'] === $productId) {
                return $index;
            }
        }
        
        return false;
    }
} 