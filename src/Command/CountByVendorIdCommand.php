<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use App\Controller\OfferController;
use Psr\Log\LoggerInterface;

class CountByVendorIdCommand extends Command
{
    protected static $defaultName = 'count_by_vendor_id';

    private OfferController $offerController;
    private LoggerInterface $logger;

    public function __construct(OfferController $offerController, LoggerInterface $logger)
    {
        parent::__construct();
        $this->offerController = $offerController;
        $this->logger = $logger;
    }

    protected function configure(): void
    {
        $this->addArgument('vendor_id', InputArgument::REQUIRED, 'Vendor ID must be a positive number.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $vendorId = filter_var($input->getArgument('vendor_id'), FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]]);
            
            if ($vendorId === false) {
                throw new \InvalidArgumentException('Invalid vendor_id. It must be a positive integer.');
            }

            $result = $this->offerController->countByVendorId($vendorId);
            $output->writeln($result);

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            $output->writeln($e->getMessage());
            return Command::FAILURE;
        }
    }
}
