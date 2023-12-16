<?php

declare(strict_types=1);

namespace App\Livewire\Pages\Products;

use App\Contexts\Store\Domain\Cart;
use App\Contexts\Store\Domain\FavoriteProduct;
use App\Contexts\Store\Presentation\Product\Queries\FindForIndex;
use App\Contexts\Store\Presentation\Product\Queries\Results\IndexResult;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

final class Index extends Component
{
    /** @var IndexResult[] $products */
    public array $products;
    public FavoriteProduct $favoriteProduct;
    public Cart $cart;

    public function mount(
        FindForIndex $productsQuery,
        FavoriteProduct\Queries\FindByUser $favoriteProductQuery,
        Cart\Queries\FindByUser $cartQuery,
    ): void
    {
        $this->products = iterator_to_array($productsQuery->execute());
        $this->favoriteProduct = $favoriteProductQuery->execute(auth()->id());
        $this->dispatch('favorite-product-changed', count: $this->favoriteProduct->count());
        $this->cart = $cartQuery->execute(auth()->id());
        $this->dispatch('cart-changed', count: $this->cart->count());
    }

    public function render(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('livewire.pages.products.index');
    }

    public function toggleFavoriteProduct(int $productId, FavoriteProduct\Commands\Save $saveCommand): void
    {
        try {
            $this->favoriteProduct->toggle($productId);
            $saveCommand->execute($this->favoriteProduct);
            $this->dispatch('favorite-product-changed', count: $this->favoriteProduct->count());
        } catch (FavoriteProduct\Exceptions\LimitExceededException) {
            Toaster::warning('お気に入りの上限に達しました');
        }
    }

    public function addToCart(int $productId, Cart\Commands\Save $saveCommand): void
    {
        try {
            $this->cart->add($productId);
            $saveCommand->execute($this->cart);
            $this->dispatch('cart-changed', count: $this->cart->count());
        } catch (Cart\Exceptions\LimitExceededException) {
            Toaster::warning('カートの上限に達しました');
        }
    }
}
