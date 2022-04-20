<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Input\InputArgument;

use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;
use Symfony\Contracts\HttpClient\HttpClientInterface;

use Psr\Log\LoggerInterface;

class CountByVendorIdCommand extends Command
{

    // php bin/console count_by_vendor_id 12
    protected static $defaultName = 'count_by_vendor_id';

    private $client;

    private $products_remote = 'https://demo4857306.mockable.io/products';

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('vendor_id', InputArgument::REQUIRED, 'The vendor_id is required.');
    }

    protected function execute(InputInterface $input, OutputInterface $output, LoggerInterface $logger): int
    {

        $response = $this->client->request('GET', $this->products_remote);

        $return = $response->getContent();

        var_export($return); die();



        $logger->info('I just got the logger');
        $logger->error('An error occurred');
    
        $logger->critical('I left the oven on!', [
            // include extra "context" info in your logs
            'cause' => 'in_hurry',
        ]);

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
