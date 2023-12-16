<?php

declare(strict_types=1);

namespace Tests\Feature\Products;

use App\Contexts\Store\Domain\Cart;
use App\Contexts\Store\Domain\FavoriteProduct;
use App\Livewire\Pages\Products\Index;
use App\Models;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Masmerise\Toaster\Toaster;
use Tests\TestCase;

/**
 * 商品一覧
 */
final class IndexTest extends TestCase
{
    use RefreshDatabase;

    /**
     * 商品一覧を表示できること
     */
    public function test_index_page_is_displayed(): void
    {
        $user = Models\User::factory()->create();
        Models\MasterProduct::factory()->count(10)->create();

        Livewire::actingAs($user)
            ->test(Index::class)
            ->assertViewHas('products', function ($products) {
                return count($products) == 10;
            });
    }

    /**
     * お気に入り追加ができること
     */
    public function test_user_can_add_favorites(): void
    {
        $user = Models\User::factory()->create();
        $otherUser = Models\User::factory()->create();
        $products = Models\MasterProduct::factory()->count(10)->create();

        Livewire::actingAs($user)
            ->test(Index::class)
            ->call('toggleFavoriteProduct', $products[0]['id'])
            ->assertViewHas('favoriteProduct', function (FavoriteProduct $favoriteProduct) use ($products) {
                return $favoriteProduct->contains($products[0]['id'])
                    && $favoriteProduct->count() === 1;
            });

        Livewire::actingAs($otherUser)
            ->test(Index::class)
            ->assertViewHas('favoriteProduct', function (FavoriteProduct $favoriteProduct) use ($products) {
                return $favoriteProduct->count() === 0;
            });
    }

    /**
     * お気に入りの上限を超えて追加できないこと
     */
    public function test_user_cannot_add_favorite_exceeds_limit()
    {
        Toaster::fake();
        Toaster::assertNothingDispatched();

        $user = Models\User::factory()->create();
        $products = Models\MasterProduct::factory()->count(21)->create();
        $test = Livewire::actingAs($user)
            ->test(Index::class);
        foreach ($products as $product) {
            $test->call('toggleFavoriteProduct', $product['id']);
        }
        Toaster::assertDispatched('お気に入りの上限に達しました');
    }

    /**
     * カートに入れられること
     */
    public function test_user_can_add_to_cart(): void
    {
        $user = Models\User::factory()->create();
        $otherUser = Models\User::factory()->create();
        $products = Models\MasterProduct::factory()->count(10)->create();

        Livewire::actingAs($user)
            ->test(Index::class)
            ->call('addToCart', $products[0]['id'])
            ->assertViewHas('cart', function (Cart $cart) use ($products) {
                return $cart->count() === 1;
            });

        Livewire::actingAs($otherUser)
            ->test(Index::class)
            ->assertViewHas('cart', function (Cart $cart) use ($products) {
                return $cart->count() === 0;
            });
    }

    /**
     * カートの上限を超えて追加できないこと
     */
    public function test_user_cannot_add_cart_exceeds_limit()
    {
        Toaster::fake();
        Toaster::assertNothingDispatched();

        $user = Models\User::factory()->create();
        $products = Models\MasterProduct::factory()->count(11)->create();
        $test = Livewire::actingAs($user)
            ->test(Index::class);
        foreach ($products as $product) {
            $test->call('addToCart', $product['id']);
        }
        Toaster::assertDispatched('カートの上限に達しました');
    }
}
