<?php

declare(strict_types=1);

namespace App\Contexts\Store\Presentation\Product\Queries;

interface FindForIndex
{
    public function execute(): Results\IndexResultIterator;
}
