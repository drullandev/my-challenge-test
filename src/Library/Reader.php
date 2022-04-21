<?php

namespace App\Library;

use App\Interface\OfferCollectionInterface;
use App\Interface\ReaderInterface;

class Reader implements ReaderInterface {

    private $input = 'json';//E.g. it can be XML/JSON Remote Endpoint, or CSV/JSON/XML local files

    public function read(string $input): OfferCollectionInterface {
        return new OfferCollectionInterface($input);
    }

}
