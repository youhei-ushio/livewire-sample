<?php

declare(strict_types=1);

namespace App\Contexts\Store\Domain;

use App\Contexts\Store\Domain\FavoriteProduct\Exceptions\LimitExceededException;

final class FavoriteProduct
{
    private const LIMIT = 20;

    public function __construct(
        private readonly int $userId,
        private array $productIds,
    )
    {

    }

    public function count(): int
    {
        return count($this->productIds);
    }

    public function contains(int $productId): bool
    {
        return in_array($productId, $this->productIds);
    }

    public function add(int $productId): void
    {
        if ($this->contains($productId)) {
            return;
        }
        if (count($this->productIds) >= self::LIMIT) {
            throw new LimitExceededException();
        }
        $this->productIds[] = $productId;
    }

    public function remove(int $productId): void
    {
        $index = array_search($productId, $this->productIds);
        if ($index !== false) {
            unset($this->productIds[$index]);
        }
    }

    public function toggle(int $productId): void
    {
        if ($this->contains($productId)) {
            $this->remove($productId);
        } else {
            $this->add($productId);
        }
    }

    public function toArray(): array
    {
        return [
            'userId' => $this->userId,
            'productIds' => $this->productIds,
        ];
    }

    public static function fromArray(array $value): self
    {
        return new self(
            userId: $value['userId'],
            productIds: $value['productIds'],
        );
    }
}
