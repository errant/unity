<?
namespace Unity\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 *
 */
class ConfigCommand extends BaseCommand {

    protected function configure()
    {
        $this
            ->setName('config')
            ->setDescription('View Configuration')
        ;

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        print_r($this->unity->config->asArray());
    }
}
