<?
namespace Unity\Container;

use Interop\Container\ContainerInterface;

/**
 * Unity Container :: Service trait_exists
 *
 * Basic Service Functionality, to avoid copy/paste
 *
 * Implements a standard ServiceInterface along with
 * some utility functions
 *
 * @author Tom Morton
 */
trait ServiceTrait {

    /**
     * Register a Service
     *
     * Called on a Service Class to register
     * itself to the container
     *
     * @param  ContainerInterface $c Container Class Object
     */
    public static function register(ContainerInterface $c)
    {
        self::lazy($c);
    }

    /**
     * Get Provided Service
     *
     * A basic implementation that uses the
     * lowercase class Name
     *
     * @return string Service Provision
     */
    public static function provides()
    {
        return strtolower(get_class());
    }

    /**
     * Register as Lazy Loading Service
     *
     * @param  ContainerInterface $c
     */
    public static function lazy(ContainerInterface $c)
    {
        static $serviceObject;
        $c->register(self::provides(), function() use (&$serviceObject)  {
            if(!$serviceObject) {
                $serviceObject = new self;
            }

            return $serviceObject;
        });
    }

    /**
     * Register as Unique Service
     *
     * Always returns a unique Service
     *
     * @param  ContainerInterface $c
     */
    public static function unique(ContainerInterface $c)
    {
        $c->register(self::provides(), function()  {
            return new self;
        });
    }

    /**
     * Register as Eager  Service
     *
     * @param  ContainerInterface $c
     */
    public static function eager(ContainerInterface $c)
    {
        $c->register(self::provides(), new self);
    }
}
