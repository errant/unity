<?
namespace Unity\Config;

use Unity\Config\ConfigInterface;

class DefaultConfig implements ConfigInterface {
    public function __construct(\Unity\Config $config)
    {
        $this->config = $config;
    }
    public function asArray()
    {
        return array(
            'userConfigFile' => '.unity'
        );
    }
}
