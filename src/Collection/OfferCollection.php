<?php

namespace App\Collection;

use App\Interface\OfferCollectionInterface;
use App\Iterator\OfferCollectionIterator;
use App\DTOs\OfferDTO;
use Iterator;
use Countable;
use InvalidArgumentException;
use OutOfRangeException;

class OfferCollection implements OfferCollectionInterface, Countable
{
    public function __construct(private readonly array $offers)
    {
        if (!is_iterable($offers) || empty($offers)) {
            throw new InvalidArgumentException("OfferCollection must be initialized with a non-empty iterable.");
        }

        $this->offers = array_map(fn($offer) => 
            $offer instanceof OfferDTO ? $offer : new OfferDTO(
                $offer->offerId, 
                $offer->productTitle, 
                $offer->vendorId, 
                $offer->price
            ), 
            $offers
        );
    }

    public function get(int $index): OfferDTO
    {
        return $this->offers[$index] ?? throw new OutOfRangeException("Invalid index: $index");
    }

    public function getIterator(): Iterator
    {
        return new OfferCollectionIterator($this->offers);
    }

    public function count(): int
    {
        return count($this->offers);
    }

    public function toArray(): array
    {
        return array_map(fn(OfferDTO $offer) => get_object_vars($offer), $this->offers);
    }
}
