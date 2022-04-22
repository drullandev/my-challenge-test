<?php

namespace App\Controller;

use App\Utils\Reader;

class ProductController {

    private $type = 'json';

    function __construct()
    {
        $reader = new Reader();
        $read = $reader->read($this->type);
        $this->iterator = $read->getIterator();
    }

    public function countByVendorId(int $id) : int
    {       
        $reader = new Reader();
        $read = $reader->read($this->type);
        $iterator = $read->getIterator();

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
