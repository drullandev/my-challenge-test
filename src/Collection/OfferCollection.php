<?php

namespace App\Collection;

use App\Interface\OfferCollectionInterface;
use App\Interface\OfferInterface;
use App\Iterator\OfferCollectionIterator;

class OfferCollection implements OfferCollectionInterface {

    private $index = 0;

    public function get(int $index): OfferInterface {
        return $this->items[$index];
    }

    public function getIterator(): Iterator {
        // https://refactoring.guru/es/design-patterns/iterator/php/example#example-1
        return new OfferCollectionIterator($this);
    }

}