<?php

namespace App\Interface;

use IteratorAggregate;

interface OfferCollectionInterface extends IteratorAggregate
{
    public function get(int $index): OfferInterface;
}
