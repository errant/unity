<?
namespace Unity\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
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
        $c->get('command')->add(new static($c, $c->get('event')));
    }

    public function __construct(\Unity\Unity $unity, $event)
    {
        parent::__construct();

        $this->unity = $unity;
        $this->event = $event;
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->event->emit('command.execute', $this->getName());
    }
}
