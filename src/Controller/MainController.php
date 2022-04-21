<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Iterator\OfferIterator;

use App\Interface\OfferCollectionInterface;
use App\Interface\OfferInterface;
use App\Interface\ReaderInterface;

use App\Collection\OfferCollection;

class MainController {

    public function CountByVendorIdCommand(){
        return 'hi';
    }

}