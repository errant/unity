<?
namespace Unity\Config;

interface ConfigInterface {
    public function __construct(\Unity\Config $config);
    public function asArray();
}
