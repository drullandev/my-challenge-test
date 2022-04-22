<?php

namespace App\Utils;

use App\Interface\ReaderInterface;

use App\Collection\OfferCollection;

use Symfony\Component\HttpClient\HttpClient;

class Reader implements ReaderInterface {    

    private $location = 'remote';
    private $remote = 'http://demo4857306.mockable.io/products';
    private $local = './public/products.json';

    public function read(string $input): OfferCollection
    {
        switch($input){
            case 'json':
                $client = HttpClient::create();
                $response = $client->request('GET', $this->remote);    
                $content = json_decode($response->getContent());
                return new OfferCollection($content);
            default:
        }

    }

}