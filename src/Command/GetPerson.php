<?
namespace App\Command;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
 
class GetPerson extends Command
{
    protected function configure()
    {
        $this->setName('app:get-person')
            ->setDescription('Get a person.')
            ->setHelp('Get a person with defined parameters.')
            ->addArgument('firstName', InputArgument::REQUIRED, 'Pass the firstname.')
            ->addArgument('lastName', InputArgument::REQUIRED, 'Pass the lastname.')
            ->addArgument('dayOfBirth', InputArgument::OPTIONAL, 'Pass the day of birth.')
        ;
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getArgument('dayOfBirth') !== null) {
            try {
                $date = new \DateTime($input->getArgument('dayOfBirth'));
            }
            catch (\Exception $e) {
                $output->writeln($e->getMessage());
                return 0;
            }

            $person = new \App\Person(
                $input->getArgument('firstName'), 
                $input->getArgument('lastName'), 
                $date
            );
            $output->writeln(sprintf("%s %s, %s", 
                $person->getFirstName(), 
                $person->getLastName(), 
                $person->getDayOfBirth()->format('d-m-Y'))
            );
        }
        else {
            $person = new \App\Person(
                $input->getArgument('firstName'), 
                $input->getArgument('lastName')
            );
            $output->writeln("{$person->getFirstName()} {$person->getLastName()}");
        }

        return 1;
    }
}