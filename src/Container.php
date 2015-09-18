<?
namespace Unity;

use Interop\Container\ContainerInterface;
use Unity\Container\Exception\NotFoundException;
use Unity\Container\Exception\ContainerException;

/**
 * Unity Container :: Container Class
 *
 * @author Tom Morton
 */
class Container implements ContainerInterface {

    public $services = array();

    public function get($id)
    {
        if(!$this->has($id)) {
            throw new NotFoundException($id);
        }

        if(is_object($this->services[$id])) {
            return $this->services[$id];
        }

        if(!is_callable($this->services[$id])) {
            throw new ContainerException($id . ' has no valid service expression');
        }

        return call_user_func($this->services[$id]);
    }

    public function has($id)
    {
        return array_key_exists($id, $this->services);
    }

    public function register($id, $callable)
    {
        $this->services[$id] = $callable;
    }
}
