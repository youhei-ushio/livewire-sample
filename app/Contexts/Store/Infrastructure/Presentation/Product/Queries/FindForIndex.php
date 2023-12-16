<?php

declare(strict_types=1);

namespace App\Contexts\Store\Infrastructure\Presentation\Product\Queries;

use App\Contexts\Store\Presentation\Product\Queries\FindForIndex as QueryInterface;
use App\Contexts\Store\Presentation\Product\Queries\Results\IndexResult;
use App\Contexts\Store\Presentation\Product\Queries\Results\IndexResultIterator;
use App\Models;
use IteratorIterator;
use Traversable;

final readonly class FindForIndex implements QueryInterface
{
    public function execute(): IndexResultIterator
    {
        return new class($this->findFromDb()) extends IteratorIterator implements IndexResultIterator
        {
            public function current(): IndexResult
            {
                return parent::current();
            }
        };
    }

    private function findFromDb(): Traversable
    {
        $rows = Models\MasterProduct::query()
            ->get();
        foreach ($rows as $row) {
            yield new IndexResult(
                id: $row->id,
                name: $row->name,
                price: $row->price,
                imageName: $row->image_name,
            );
        }
    }
}
