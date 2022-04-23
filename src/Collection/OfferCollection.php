<?php

namespace App\Collection;

use App\Interface\OfferCollectionInterface;
use App\Interface\OfferInterface;

use App\Iterator\OfferCollectionIterator;
use Iterator;

class OfferCollection implements OfferCollectionInterface {

    private $offers;

    function __construct($offers)
    {
        $this->offers = $offers;
    }

    public function get(int $index): OfferInterface
    {
        return $this->offers[$index];
    }

    public function getIterator(): Iterator
    {
        return new OfferCollectionIterator($this->offers);
    }

}
