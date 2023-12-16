<?php

declare(strict_types=1);

namespace App\Contexts\Store\Domain\Cart\Queries;

use App\Contexts\Store\Domain\Cart;

interface FindByUser
{
    public function execute(int $userId): Cart;
}
