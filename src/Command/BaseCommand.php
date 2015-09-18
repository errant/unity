<?
namespace Unity\Command;

use Symfony\Component\Console\Command\Command;
use Interop\Container\ContainerInterface;
use Unity\Container\ServiceInterface;
use Unity\Container\ServiceTrait;

/**
 *
 */
abstract class BaseCommand extends Command implements ServiceInterface
{
    use ServiceTrait;

    public static function register(ContainerInterface $c)
    {
        $c->get('command')->add(new static($c));
    }

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
