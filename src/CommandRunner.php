<?
namespace Unity;

use Symfony\Component\Console\Application;
use Interop\Container\ContainerInterface;

class CommandRunner extends Application  {

    public static function registerService(ContainerInterface $c)
    {
        $c->register('command', new self('Unity', $c->getVersion()));
    }
}
