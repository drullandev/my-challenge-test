<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use App\Controller\OfferController;
use Psr\Log\LoggerInterface;

class CountByPriceRangeCommand extends Command
{
    protected static $defaultName = 'count_by_price_range';

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
        $this
            ->addArgument('price_from', InputArgument::REQUIRED, 'Starting price (must be numeric and >= 0).')
            ->addArgument('price_to', InputArgument::REQUIRED, 'Ending price (must be numeric and greater than price_from).');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $priceFrom = filter_var($input->getArgument('price_from'), FILTER_VALIDATE_FLOAT);
            $priceTo = filter_var($input->getArgument('price_to'), FILTER_VALIDATE_FLOAT);

            if ($priceFrom === false || $priceTo === false || $priceFrom < 0 || $priceFrom >= $priceTo) {
                throw new \InvalidArgumentException('Invalid price range. Ensure values are numeric, price_from >= 0, and price_to > price_from.');
            }

            $result = $this->offerController->countByPriceRange($priceFrom, $priceTo);
            $output->writeln($result);

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            $output->writeln($e->getMessage());
            return Command::FAILURE;
        }
    }
}
