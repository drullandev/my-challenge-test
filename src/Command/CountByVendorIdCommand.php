<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;

use Symfony\Component\Console\Output\OutputInterface;

use App\Controller\ProductsController;

class CountByVendorIdCommand extends Command
{

    // php bin/console count_by_vendor_id 35
    protected static $defaultName = 'count_by_vendor_id';

    protected function configure(): void
    {
        $this->addArgument('vendor_id', InputArgument::REQUIRED, 'The vendor_id is required.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        try {

            $args = $input->getArguments();

            $pdc = new ProductsController();

            $result = $pdc->countByVendorId($args['vendor_id']);

            $output->writeln([$result]);

        } catch(\Exception $e){

            $output->writeln([$e->getMessage()]);

            // or return this if some error happened during the execution
            // (it's equivalent to returning int(1))
            //return Command::FAILURE;

            // or return this to indicate incorrect command usage; e.g. invalid options
            // or missing arguments (it's equivalent to returning int(2))
            // return Command::INVALID

        }

        // (it's equivalent to returning int(0))
        return Command::SUCCESS;



    }
    
}
