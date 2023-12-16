<?php

declare(strict_types=1);

namespace App\Contexts\Store\Domain\FavoriteProduct\Queries;

use App\Contexts\Store\Domain\FavoriteProduct;

interface FindByUser
{
    public function execute(int $userId): FavoriteProduct;
}
