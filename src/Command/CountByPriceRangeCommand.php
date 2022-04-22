<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;

use Symfony\Component\Console\Output\OutputInterface;

use App\Controller\ProductsController;

class CountByPriceRangeCommand extends Command
{

    // php bin/console count_by_price_range 12.00 145.80
    protected static $defaultName = 'count_by_price_range';

    protected function configure(): void
    {
        $this
            ->addArgument('price_from', InputArgument::REQUIRED, 'The price_from is required.')
            ->addArgument('price_to', InputArgument::REQUIRED, 'The price_to is required.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
       
        try {

            $args = $input->getArguments();

            if(!is_numeric($args['price_from'])){
                throw new \Exception("The price_from must be numeric.\n");
            }

            if(!is_numeric($args['price_to'])){
                throw new \Exception("The price_from must be numeric.\n");
            }

            if($args['price_from'] < 0){
                throw new \Exception("The price_from cannot be less than 0.\n");
            }

            if ($args['price_from'] == $args['price_to'] ) {            
                throw new \Exception("The values price_from and price_to are the same.\n");
            }

            if ($args['price_from'] >= $args['price_to'] ) {            
                throw new \Exception("The price_to must be greater than price_from.\n");
            }

            $pdc = new ProductsController();
            
            echo $pdc->countByPriceRange($args['price_from'], $args['price_to'])."\n";

        } catch(\Exception $e){

            echo $e->getMessage();
            // or return this if some error happened during the execution
            // (it's equivalent to returning int(1))
            return Command::FAILURE;

        }

        // (it's equivalent to returning int(0))
        return Command::SUCCESS;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID

    }
    
}
