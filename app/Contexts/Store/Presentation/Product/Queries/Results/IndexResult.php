<?php

declare(strict_types=1);

namespace App\Contexts\Store\Presentation\Product\Queries\Results;

final readonly class IndexResult
{
    public function __construct(
        public int $id,
        public string $name,
        public int $price,
        public string $imageName,
    )
    {

    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function fromArray(array $value): self
    {
        return new self(
            id: $value['id'],
            name: $value['name'],
            price: $value['price'],
            imageName: $value['imageName'],
        );
    }
}
