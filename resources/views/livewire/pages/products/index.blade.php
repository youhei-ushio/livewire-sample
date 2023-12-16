<div>
    <x-slot name="title">
        {{ __('商品一覧') }}
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <x-auth-session-status class="mb-4" :status="session('status')" />
                <ul class="mt-3 grid grid-cols-2 md:grid-cols-6 gap-5">
                    @foreach ($products as $product)
                        <li class="mt-2 border border-gray-400 p-2 rounded-lg relative">
                            <img src="/storage/images/products/{{ $product->imageName }}"
                                 class="inline min-h-[100px] max-w-[130px] ms-2" alt="{{ $product->id }}">
                            <div class="text-lg text-center underline">
                                {{ $product->name }}
                            </div>
                            <div class="mt-2 text-center">
                                {{ number_format($product->price) }} {{ __('円') }}
                            </div>
                            <div class="mt-2 text-center">
                                <x-secondary-button wire:click="addToCart({{ $product->id }})">
                                    {{ __('カートにいれる') }}
                                </x-secondary-button>
                            </div>
                            <x-favorite-button status="{{ $favoriteProduct->contains($product->id) }}" wire:click="toggleFavoriteProduct({{ $product->id }})" />
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
