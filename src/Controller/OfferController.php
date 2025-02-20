<?php

namespace App\Controller;

use App\Utils\Reader;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OfferController 
{
    private Reader $reader;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->reader = new Reader($httpClient);
    }

    public function countByVendorId(int $id): int
    {
        $read = $this->reader->read('json');
        $iterator = $read->getIterator();
        $count = 0;

        foreach ($iterator as $key => $row) {
            if ($read->get($key)->getVendorId() === $id) {
                $count++;
            }
        }

        return $count;
    }

    public function countByPriceRange(int $price_from, int $price_to): int
    {       
        $read = $this->reader->read('json');
        $iterator = $read->getIterator();
        $count = 0;

        foreach ($iterator as $key => $row) {
            $price = $read->get($key)->getPrice();
            if ($price >= $price_from && $price <= $price_to) {
                $count++;
            }
        }

        return $count;
    }
}
