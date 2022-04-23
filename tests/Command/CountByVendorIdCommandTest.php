<?php

namespace tests\Command;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class CountByVendorIdCommand extends KernelTestCase
{

    public function testExecute()
    {

        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $command = $application->find('count_by_vendor_id');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'vendor_id' => 35
        ]);

        $commandTester->assertCommandIsSuccessful();

        $output = $commandTester->getDisplay();

        $this->assertStringContainsString(2, $output);

    }

}
