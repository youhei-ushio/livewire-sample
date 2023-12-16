<?php

declare(strict_types=1);

namespace App\Contexts\Store\Domain;

use App\Contexts\Store\Domain\Cart\Exceptions\LimitExceededException;

final class Cart
{
    private const LIMIT = 10;

    /**
     * @param int[] $products
     */
    public function __construct(
        private readonly int $userId,
        private array $products,
    )
    {

    }

    public function count(): int
    {
        return count($this->products);
    }

    public function add(int $productId): void
    {
        if (!array_key_exists($productId, $this->products)) {
            if (count($this->products) >= self::LIMIT) {
                throw new LimitExceededException();
            }
            $this->products[$productId] = 0;
        }
        $this->products[$productId]++;
    }

    public function remove(int $productId): void
    {
        if (!array_key_exists($productId, $this->products)) {
            return;
        }
        $this->products[$productId]--;
        if ($this->products[$productId] <= 0) {
            unset($this->products[$productId]);
        }
    }

    public function toArray(): array
    {
        return [
            'userId' => $this->userId,
            'products' => $this->products,
        ];
    }

    public static function fromArray(array $value): self
    {
        return new self(
            userId: $value['userId'],
            products: $value['products'],
        );
    }
}
