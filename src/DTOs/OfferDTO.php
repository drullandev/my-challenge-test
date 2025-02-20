<?php

namespace App\DTOs;

use App\Interface\OfferInterface;

class OfferDTO implements OfferInterface
{
    public function __construct(
        public readonly int $offerId,
        public readonly string $productTitle,
        public readonly int $vendorId,
        public readonly float $price
    ) {}

    public function getOfferId(): int
    {
        return $this->offerId;
    }

    public function getProductTitle(): string
    {
        return $this->productTitle;
    }

    public function getVendorId(): int
    {
        return $this->vendorId;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
