<?php

namespace App\Controller;

use App\Utils\Reader;

class OfferController {

    public function countByVendorId(int $id) : int
    {
        $reader = new Reader();
        $read = $reader->read('json');
        $iterator = $read->getIterator();
        $count = 0;
        foreach($iterator as $key => $row){
            $offer = $read->get($key);
            if($offer->vendorId == $id ){
                $count++;
            }
        }
        return $count;
    }

    public function countByPriceRange(int $price_from, int $price_to) : int
    {       
        $reader = new Reader();
        $read = $reader->read('json');
        $iterator = $read->getIterator();
        $count = 0;
        foreach($iterator as $key => $row){
            $offer = $read->get($key);
            if($offer->price >= $price_from && $offer->price <= $price_to ){
                $count++;
            }
        }
        return $count;
    }

}
