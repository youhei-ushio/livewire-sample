<?php

declare(strict_types=1);

namespace App\Livewire\Synthesizers\Presentation\Product\Queries;

use App\Contexts\Store\Presentation\Product\Queries\Results\IndexResult;
use Livewire\Mechanisms\HandleComponents\Synthesizers\Synth;

final class IndexResultSynth extends Synth
{
    public static $key = 'product.index.result';

    public static function match($target): bool
    {
        return $target instanceof IndexResult;
    }

    public function dehydrate(IndexResult $target): array
    {
        return [$target->toArray(), []];
    }

    public function hydrate($value): IndexResult
    {
        return IndexResult::fromArray($value);
    }
}
