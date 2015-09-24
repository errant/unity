<?
namespace Unity\Config;

use Unity\Config\ConfigInterface;

class UserConfig implements ConfigInterface {

    protected $configArray = array();

    public function __construct(\Unity\Config $config)
    {
        $this->config = $config;

        $filePath = realpath($this->config['userConfigFile']);

        if(is_file($filePath)) {
            $unity = $this->config->unity;
            $config = $this;
            require $filePath;
        }
    }

    public function create($config)
    {
        $this->configArray = array_merge($this->configArray, $config);
    }

    public function asArray()
    {
        return $this->configArray;
    }

}
