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

        $service = $this->services[$id];

        // Object but NOT a closure
        if(is_object($service)  && !($service instanceof \Closure)) {
            return $service;
        }

        if(!is_callable($service)) {
            throw new ContainerException($id . ' has no valid service expression');
        }
        return call_user_func($service);
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
