<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;

use Symfony\Component\Console\Output\OutputInterface;

use App\Controller\ProductController;

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

            if(!is_numeric($args['vendor_id'])){
                throw new \Exception('The vendor_id must be numeric.');
            }

            if($args['vendor_id'] <= 0){
                throw new \Exception('The vendor_id must greater than 0.');
            }

            $pdc = new ProductController();

            $result = $pdc->countByVendorId($args['vendor_id']);

            $output->writeln([$result]);

            return Command::SUCCESS;
            
        } catch(\Exception $e){

            $output->writeln([$e->getMessage()]);

            return Command::INVALID;

        }

    }
    
}
