<?php

declare(strict_types=1);

namespace App\Livewire\Synthesizers\Domain;

use App\Contexts\Store\Domain\Cart;
use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;

final class CartSynth extends Synth
{
    public static $key = 'cart';

    public static function match($target): bool
    {
        return $target instanceof Cart;
    }

    public function dehydrate(Cart $target): array
    {
        return [$target->toArray(), []];
    }

    public function hydrate($value): Cart
    {
        return new Cart(
            $value['userId'],
            $value['products'],
        );
    }
}
