<?php

declare(strict_types=1);

namespace App\Contexts\Store\Infrastructure\Domain\Cart\Commands;

use App\Contexts\Store\Domain\Cart;
use App\Contexts\Store\Domain\Cart\Commands\Save as CommandInterface;
use App\Models;

final readonly class Save implements CommandInterface
{
    public function execute(Cart $entity): void
    {
        $value = $entity->toArray();

        $rows = [];
        foreach ($value['products'] as $productId => $quantity) {
            $rows[] = [
                'user_id' => $value['userId'],
                'product_id' => $productId,
                'quantity' => $quantity,
            ];
        }
        Models\CartProduct::query()->upsert(
            values: $rows,
            uniqueBy: ['user_id', 'product_id'],
            update: ['quantity']);
        Models\CartProduct::query()
            ->where('user_id', $value['userId'])
            ->whereNotIn('product_id', array_keys($value['products']))
            ->delete();
    }
}
