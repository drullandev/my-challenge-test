<?php

namespace App\Interface;

interface OfferInterface
{
    public function getOfferId(): int;
    public function getProductTitle(): string;
    public function getPrice(): float;
    public function getVendorId(): int;
}
