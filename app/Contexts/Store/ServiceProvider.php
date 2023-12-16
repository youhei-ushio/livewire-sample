<?php

declare(strict_types=1);

namespace App\Contexts\Store;

use App\Livewire\Synthesizers;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Livewire\Livewire;

final class ServiceProvider extends BaseServiceProvider
{
    public array $bindings = [
        Presentation\Product\Queries\FindForIndex::class => Infrastructure\Presentation\Product\Queries\FindForIndex::class,
        Domain\FavoriteProduct\Queries\FindByUser::class => Infrastructure\Domain\FavoriteProduct\Queries\FindByUser::class,
        Domain\FavoriteProduct\Commands\Save::class => Infrastructure\Domain\FavoriteProduct\Commands\Save::class,
        Domain\Cart\Queries\FindByUser::class => Infrastructure\Domain\Cart\Queries\FindByUser::class,
        Domain\Cart\Commands\Save::class => Infrastructure\Domain\Cart\Commands\Save::class,
    ];

    public function boot(): void
    {
        Livewire::propertySynthesizer(Synthesizers\Domain\CartSynth::class);
        Livewire::propertySynthesizer(Synthesizers\Domain\FavoriteProductSynth::class);
        Livewire::propertySynthesizer(Synthesizers\Presentation\Product\Queries\IndexResultSynth::class);
    }
}
