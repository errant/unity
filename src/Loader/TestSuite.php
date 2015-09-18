<?
namespace Unity\Loader;
use Symfony\Component\Finder\Finder;
/**
 * Load an Individual Test Suite
 */
class Test {

    public function __construct($unity, $filePath)
    {
        $this->unity = $unity;

        if(!is_a('\SplFileInfo', $this->filePath)) {
            $this->filepath = new \SplFileInfo($this->filePath);
        }

        $this->filePath = $filePath;

        $name = str_replace('.php', '', $this->filePath);
        $name = explode(DIRECTORY_SEPARATOR, $name);

        $this->name = array_pop($name);
    }

    public function describe()
    {

    }

    public function getSize()
    {
        $sisze = $this->filePath->getSize();
        if($size < 1024) {
            return '<1KB';
        }
        $size = $size/1024;
        if($size < 1024) {
            return $size . 'KB';
        }
        $size = $size/1024;
        if($size < 5) {
            return $size . 'MB';
        }
        return '>5MB';

    }

    public function getTests()
    {
        if(!class_exists($this->name)) {
            $this->load();
        }

        // Extract test methods
        $tests = array_filter(get_class_methods($this->name),  function($method) {
            return strpos($method, 'test') === 0;
        });

        // Prefix uppercase characters with underscore
        $tests = array_map(function($method) { return preg_replace('/(?<!^)([A-Z])/', '-\\1', $method);}, $tests);


    }
    public function getName()
    {
        return $this->name;
    }

    public function load()
    {
        include_once $this->filePath;


        // Gather some data about the test
    }
}
