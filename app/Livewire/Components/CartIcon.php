<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

final class CartIcon extends Component
{
    public int|null $count;

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.components.cart-icon');
    }

    #[On('cart-changed')]
    public function updateCount(int $count): void
    {
        $this->count = $count;
    }
}
