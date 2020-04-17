<?php
use App\Command\GetPerson;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class GetPersonCommandTest extends KernelTestCase
{
    /** @var CommandTester */
    private $commandTester;

    protected function setUp(): void
    { 
        $kernel = static::createKernel();
        $kernel->boot();

        $application = new Application($kernel);
        $application->add(new GetPerson());

        $command = $application->find('app:get-person');
        $this->commandTester = new CommandTester($command);
    }

    public function testExecute()
    {
        $this->commandTester->execute(array(
            'firstName' => 'name',
            'lastName' => 'surname'
        ));

        $output = $this->commandTester->getDisplay();
        $this->assertEquals('name surname', trim($output));
    }

    public function testExecuteWithDate()
    {
        $this->commandTester->execute(array(
            'firstName' => 'name',
            'lastName' => 'surname',
            'dayOfBirth' => '20.02.2010'
        ));

        $output = $this->commandTester->getDisplay();
        $code = $this->commandTester->getStatusCode();
        $this->assertEquals('name surname, 20-02-2010', trim($output));
        $this->assertEquals(1, $code);
    }

    public function testExecuteWithIncorrectDate()
    {
        $this->commandTester->execute(array(
            'firstName' => 'name',
            'lastName' => 'surname',
            'dayOfBirth' => '20.20.2010'
        ));

        $code = $this->commandTester->getStatusCode();
        $this->assertEquals(0, $code);
    }
}