<?php

namespace App\Interface;

interface ReaderInterface
{
    public function read(string $input): OfferCollectionInterface;
}
