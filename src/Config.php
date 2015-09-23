<?
namespace Unity;

use Unity\Container\ServiceTrait;
use Unity\Container\ServiceInterface;
use Unity\Config\ConfigInterface;
use Unity\Config\DefaultConfig;

/**
 * Unity Config Service
 *
 */
class Config implements ServiceInterface, \ArrayAccess {
    use ServiceTrait;

    protected $configHandlers = array();
    protected $config = array();

    public function __construct()
    {
        // Default Config
        $this->attach(new DefaultConfig, 100);
    }

    public function attach(ConfigInterface $configHandler, $priority = 50)
    {
        $this->configHandlers[] = array('handler' => $configHandler, 'priority' => $priority);
        // Rebuild the Config
        $this->rebuild();
    }

    public function rebuild()
    {
        // Sort Based On priority
        // Lowest Priority Score is LAST (i.e. more important)
        // A bit like MX Records
        usort($this->configHandlers, function ($left, $right) {
            if($left['priority'] == $right['priority']) {
                return 0;
            }
            return ($left['priority'] < $right['priority']) ? 1 : -1;
        });

        $sortedConfigHandlers = array_map(function($e) { return $e['handler']; }, $this->configHandlers);

        $config = array();
        foreach($sortedConfigHandlers as $configHandler) {
            $config = array_merge_recursive($config, $configHandler->asArray());
        }

        $this->config = $config;
    }

    // ArrayAccess

    public function offsetSet($offset, $value) {
        throw new \Exception('Configuration is Read Only: attach a Config Handler to modify');
    }

    public function offsetExists($offset) {
        return isset($this->config[$offset]);
    }

    public function offsetUnset($offset) {
        throw new \Exception('Configuration is Read Only: attach a Config Handler to modify');
    }

    public function offsetGet($offset) {
        return isset($this->config[$offset]) ? $this->config[$offset] : null;
    }

}
