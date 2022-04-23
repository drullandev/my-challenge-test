<?php

namespace App\Utils;

use App\Interface\ReaderInterface;

use App\Collection\OfferCollection;

use Symfony\Component\HttpClient\HttpClient;

class Reader implements ReaderInterface {    

    public function read(string $input): OfferCollection
    {
        switch($input){
            case 'json':
            default:
                $client = HttpClient::create();
                $response = $client->request('GET', 'http://demo4857306.mockable.io/products');    
                $content = json_decode($response->getContent());
                return new OfferCollection($content);
        }

    }

}