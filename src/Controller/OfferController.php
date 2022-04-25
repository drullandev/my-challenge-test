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
            $vendorId = $offer->getVendorId();
            if($vendorId == $id ){
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
            $price = $offer->getPrice();
            if($price >= $price_from && $price <= $price_to){
                $count++;
            }
        }
        return $count;
    }

}
