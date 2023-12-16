<?php

declare(strict_types=1);

namespace App\Contexts\Store\Presentation\Product\Queries\Results;

use Iterator;

interface IndexResultIterator extends Iterator
{
    public function current(): IndexResult;
}
