<?php

declare(strict_types=1);

namespace App\Contexts\Store\Domain\FavoriteProduct\Commands;

use App\Contexts\Store\Domain\FavoriteProduct;

interface Save
{
    public function execute(FavoriteProduct $entity): void;
}
