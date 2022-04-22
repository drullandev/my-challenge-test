<?php

namespace App\Controller;

use Symfony\Component\HttpClient\HttpClient;

use App\Iterator\OfferIterator;
use App\Interface\OfferCollectionInterface;
use App\Interface\OfferInterface;
use App\Interface\ReaderInterface;
use App\Collection\OfferCollection;

class ProductsController {

    private $remote = 'https://demo4857306.mockable.io/products';

    function __construct()
    {
        $client = HttpClient::create();
        $response = $client->request('GET', $this->remote);
        $this->content = json_decode($response->getContent());
    }

    public function countByVendorId(int $id) : int
    {       
        $count = 0;
        foreach($this->content as $row){
            if($row->vendorId == $id ){
                $count++;
            }
        }
        return $count;
    }

    public function countByPriceRange(int $price_from, int $price_to) : int
    {       
        $count = 0;
        foreach($this->content as $row){
            if($row->price >= $price_from && $row->price <= $price_to ){
                $count++;
            }
        }
        return $count;
    }

}