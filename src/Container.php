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

    /**
     * Get Service
     *
     * @param  string $id Service Name
     * @return object     Service
     * @throws NotFoundException when no service exists for ID
     * @throws ContainerException when service cannot be loaded
     */
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

    /**
     * Magic Getters
     *
     * Allows access to services via ->service
     * @param  string $id Service Name
     * @return object     Service
     * @throws NotFoundException when no service exists for ID
     * @throws ContainerException when service cannot be loaded
     */
    public function __get($id)
    {
        return $this->get($id);
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
