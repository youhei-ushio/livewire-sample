<?php

declare(strict_types=1);

namespace App\Contexts\Store\Domain\Cart\Commands;

use App\Contexts\Store\Domain\Cart;

interface Save
{
    public function execute(Cart $entity): void;
}
