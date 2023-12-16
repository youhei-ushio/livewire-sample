<?php

declare(strict_types=1);

namespace App\Contexts\Store\Infrastructure\Domain\FavoriteProduct\Commands;

use App\Contexts\Store\Domain\FavoriteProduct;
use App\Contexts\Store\Domain\FavoriteProduct\Commands\Save as CommandInterface;
use App\Models;

final readonly class Save implements CommandInterface
{
    public function execute(FavoriteProduct $entity): void
    {
        $value = $entity->toArray();

        $rows = [];
        foreach ($value['productIds'] as $productId) {
            $rows[] = [
                'user_id' => $value['userId'],
                'product_id' => $productId,
            ];
        }
        Models\FavoriteProduct::query()->upsert(
            values: $rows,
            uniqueBy: ['user_id', 'product_id'],
            update: []);
        Models\FavoriteProduct::query()
            ->where('user_id', $value['userId'])
            ->whereNotIn('product_id', $value['productIds'])
            ->delete();
    }
}
