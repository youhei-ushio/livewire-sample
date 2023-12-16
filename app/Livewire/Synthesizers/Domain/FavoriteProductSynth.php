<?php

declare(strict_types=1);

namespace App\Livewire\Synthesizers\Domain;

use App\Contexts\Store\Domain\FavoriteProduct;
use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;

final class FavoriteProductSynth extends Synth
{
    public static $key = 'favorite_product';

    public static function match($target): bool
    {
        return $target instanceof FavoriteProduct;
    }

    public function dehydrate(FavoriteProduct $target): array
    {
        return [$target->toArray(), []];
    }

    public function hydrate($value): FavoriteProduct
    {
        return FavoriteProduct::fromArray($value);
    }
}
