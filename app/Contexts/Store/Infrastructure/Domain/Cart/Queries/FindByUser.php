<?php

declare(strict_types=1);

namespace App\Contexts\Store\Infrastructure\Domain\Cart\Queries;

use App\Contexts\Store\Domain\Cart;
use App\Contexts\Store\Domain\Cart\Queries\FindByUser as QueryInterface;
use App\Models;

final readonly class FindByUser implements QueryInterface
{
    public function execute(int $userId): Cart
    {
        $rows = Models\CartProduct::query()
            ->where('user_id', $userId)
            ->get();
        $products = [];
        foreach ($rows as $row) {
            $products[$row->product_id] = $row->quantity;
        }
        return new Cart(
            userId: $userId,
            products: $products,
        );
    }
}
