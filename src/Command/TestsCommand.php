<?
namespace Unity\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *
 */
class TestsCommand extends BaseCommand
{
    protected function configure()
    {
        $this
            ->setName('tests')
            ->setDescription('Lists Unit Test Classes')
        ;

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $dir = new \Unity\Loader\Directory($this->unity, $this->unity->baseDir . '/tests');

        foreach($dir->getTests() as $test) {
            $test->describe();
        }
    }
}
