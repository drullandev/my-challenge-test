<?php

namespace App\Collection;

use App\Interface\OfferCollectionInterface;
use App\Iterator\OfferCollectionIterator;
use App\DTOs\OfferDTO;

use Iterator;

class OfferCollection implements OfferCollectionInterface {

    private $offers;

    function __construct($offers)
    {
        $this->offers = $offers;
    }

    public function get(int $index): OfferDTO
    {
        $offer = $this->offers[$index];
        return new OfferDTO($offer->offerId, $offer->productTitle, $offer->vendorId, $offer->price);
    }

    public function getIterator(): Iterator
    {
        return new OfferCollectionIterator($this->offers);
    }

}
