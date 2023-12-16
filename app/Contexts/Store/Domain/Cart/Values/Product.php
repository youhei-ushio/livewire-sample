<?php

declare(strict_types=1);

namespace App\Contexts\Store\Domain\Cart\Values;

final class Product
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly int $price,
    )
    {

    }
}
