<?php

namespace tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CountByPriceRangeCommandTest extends KernelTestCase
{

    public function testExecute()
    {

        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('count_by_price_range');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'price_from' => 12,
            'price_to' => 145
        ]);

        $commandTester->assertCommandIsSuccessful();
        
        $output = $commandTester->getDisplay();

        $this->assertStringContainsString(1, $output);

    }

}
