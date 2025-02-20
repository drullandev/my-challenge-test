<?php

namespace App\Utils;

use App\Interface\ReaderInterface;
use App\Collection\OfferCollection;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Reader implements ReaderInterface
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function read(string $input): OfferCollection
    {
        if ($input !== 'json') {
            throw new \InvalidArgumentException("Unsupported input type: $input");
        }

        $response = $this->client->request('GET', 'http://demo4857306.mockable.io/products');
        $content = json_decode($response->getContent(), false, 512, JSON_THROW_ON_ERROR);

        if (!is_array($content)) {
            throw new \UnexpectedValueException("Invalid JSON response format.");
        }

        return new OfferCollection($content);
    }
}

}