<?
namespace Unity\Command;

use Symfony\Component\Console\Command\Command;

/**
 *
 */
abstract class BaseCommand extends Command
{
    public function __construct(\Unity\Unity $unity)
    {
        parent::__construct();

        $this->unity = $unity;
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->unity->emit('command.execute', $this->getName());
    }
}
