<?php

namespace App\Controller;

use App\Utils\Reader;

class OfferController {

    private $type = 'json';

    function __construct()
    {
        $reader = new Reader();
        $read = $reader->read($this->type);
        $this->iterator = $read->getIterator();
        var_export($this->iterator); die();
    }

    public function countByVendorId(int $id) : int
    {       
        $count = 0;
        foreach($this->iterator as $key => $row){
            if($row->vendorId == $id ){
                $count++;
            }
        }
        return $count;
    }

    public function countByPriceRange(int $price_from, int $price_to) : int
    {       
        $count = 0;
        foreach($this->iterator as $key => $row){
            if($row->price >= $price_from && $row->price <= $price_to ){
                $count++;
            }
        }
        return $count;
    }

}
