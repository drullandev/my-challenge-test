<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;

use Symfony\Component\Console\Output\OutputInterface;

use App\Controller\ProductController;

use Psr\Log\LoggerInterface;

// php bin/console count_by_price_range 12.00 145.80
class CountByPriceRangeCommand extends Command
{

    protected static $defaultName = 'count_by_price_range';

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        parent::__construct();
    }

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
                throw new \Exception('The price_from must be numeric.');
            }

            if(!is_numeric($args['price_to'])){
                throw new \Exception('The price_from must be numeric.');
            }

            if($args['price_from'] < 0){
                throw new \Exception('The price_from cannot be less than 0.');
            }

            if ($args['price_from'] == $args['price_to'] ) {            
                throw new \Exception('The values price_from and price_to are the same.');
            }

            if ($args['price_from'] >= $args['price_to'] ) {            
                throw new \Exception('The price_to must be greater than price_from.');
            }

            $pdc = new ProductController();
            
            $result = $pdc->countByPriceRange($args['price_from'], $args['price_to']);

            $output->writeln([$result]);

            return Command::SUCCESS;

        } catch(\Exception $e){

            $output->writeln([$e->getMessage()]);

            $this->logger->error($e->getMessage());

            return Command::INVALID;

        }

    }
    
}
