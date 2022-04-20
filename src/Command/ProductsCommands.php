<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;

use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ProductsCommand extends Command
{

    // php bin/console products:count_by_price_range 12.00 145.80
    protected static $defaultName = 'count_by_price_range';

    private $client;

    private $products_remote = 'https://demo4857306.mockable.io/products';

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        parent::__construct();
    }


    protected function configure(): void
    {
        $this
            ->addArgument('min_price', InputArgument::REQUIRED, 'The min_price is required.')
            ->addArgument('max_price', InputArgument::REQUIRED, 'The max price is required.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $response = $this->client->request('GET', $this->products_remote);
        var_export($response->toArray()); die();

        // (it's equivalent to returning int(0))
        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID

    }

}
