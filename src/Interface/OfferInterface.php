<?php

namespace App\Interface;

/**
* Interface of Data Transfer Object, that represents external JSON data
*/
interface OfferInterface
{

    public function getPrice(): float;

    public function getVendorId(): int;
    
}