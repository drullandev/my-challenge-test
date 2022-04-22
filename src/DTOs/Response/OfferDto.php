<?php

namespace App\Dto\Response;

use JMS\Serializer\Annotation as Serialization;

class OfferDto {

    /**
     * @Serialization\Type("int")
     */
    public int $offerId;

    /**
     * @Serialization\Type("string")
     */
    public string $productTitle;

    /**
     * @Serialization\Type("int")
     */
    public int $vendorId;

    /**
     * @Serialization\Type("float")
     */
    public float $price;
}
