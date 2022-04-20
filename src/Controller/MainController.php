<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use JMS\Serializer\Annotation as Serialization;
use App\Iterator\OfferIterator;


/**
* Interface of Data Transfer Object, that represents external JSON data
*/
interface OfferInterface {}


/**
* Interface for The Collection class that contains Offers
*/
interface OfferCollectionInterface {

    public function get(int $index): OfferInterface;

    public function getIterator(): Iterator;

}

class OfferCollection implements OfferCollectionInterface {

    private $index = 0;

    public function get(int $index): OfferInterface {
        return $this->items[$index];
    }

    public function getIterator(): Iterator {
        // https://refactoring.guru/es/design-patterns/iterator/php/example#example-1
        return new OfferCollectionIterator($this);
    }

}




/**
* The interface provides the contract for different readers
* E.g. it can be XML/JSON Remote Endpoint, or CSV/JSON/XML local files
*/
interface ReaderInterface {

    /**
    * Read in incoming data and parse to objects
    */
    public function read(string $input): OfferCollectionInterface;

}

class Reader implements ReaderInterface {

    private $input = 'json';//E.g. it can be XML/JSON Remote Endpoint, or CSV/JSON/XML local files

    public function read(string $input): OfferCollectionInterface {
        return new OfferCollectionInterface($input);
    }

}



class MainController {

    public function hi(){
        return 'hi';
    }

}