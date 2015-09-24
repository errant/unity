<?
namespace Unity\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *
 */
class RunCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('run')
            ->setDescription('Run Unit Tests')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dir = new \Unity\Loader\Directory($this->unity, $this->unity->baseDir . '/tests');

        foreach($dir->getTests() as $testSuite) {
            $this->unity->pushTest($testSuite);
        }

        $this->unity->stack->run();
    }
}
