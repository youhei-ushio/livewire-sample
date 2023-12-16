<?php

declare(strict_types=1);

namespace App\Contexts\Store\Infrastructure\Domain\FavoriteProduct\Queries;

use App\Contexts\Store\Domain\FavoriteProduct;
use App\Contexts\Store\Domain\FavoriteProduct\Queries\FindByUser as QueryInterface;
use App\Models;

final readonly class FindByUser implements QueryInterface
{
    public function execute(int $userId): FavoriteProduct
    {
        $productIds = Models\FavoriteProduct::query()
            ->where('user_id', $userId)
            ->get()
            ->pluck('product_id')
            ->toArray();
        return new FavoriteProduct(
            userId: $userId,
            productIds: $productIds,
        );
    }
}
