<?php

namespace App\DTOs;

use App\Interface\OfferInterface;

class OfferDTO implements OfferInterface
{

    public function __construct(int $offerId, string $productTitle, int $vendorId, float $price)
    {
        $this->offerId = $offerId;
        $this->productTitle = $productTitle;
        $this->vendorId = $vendorId;
        $this->price = $price;
    }

}