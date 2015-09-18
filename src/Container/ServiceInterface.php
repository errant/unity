<?
namespace Unity\Container;

use Interop\Container\ContainerInterface;
/**
 * Unity Container :: Service Interface
 *
 * @author Tom Morton
 */
interface ServiceInterface {
    /**
     * Register a Service
     *
     * Called on a Service Class to register
     * itself to the container
     *
     * @param  ContainerInterface $c Container Class Object
     */
    public static function register(ContainerInterface $c);

    /**
     * Get Provided Service
     *
     * @return string Provided service
     */
    public static function provides();
}
