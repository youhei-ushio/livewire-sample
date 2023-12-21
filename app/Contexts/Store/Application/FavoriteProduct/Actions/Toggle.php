<?php

declare(strict_types=1);

namespace App\Contexts\Store\Application\FavoriteProduct\Actions;

use App\Contexts\Store\Domain\FavoriteProduct\Commands\Save;
use App\Contexts\Store\Domain\FavoriteProduct\Queries\FindByUser;

final readonly class Toggle
{
    public function __construct(
        private FindByUser $findQuery,
        private Save $saveCommand,
    )
    {

    }

    public function execute(int $userId, int $productId): void
    {
        $favoriteProduct = $this->findQuery->execute($userId);
        $favoriteProduct->toggle($productId);
        $this->saveCommand->execute($favoriteProduct);
    }
}
