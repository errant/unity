<?
namespace Unity\Loader;
use Symfony\Component\Finder\Finder;
/**
 * Load an Individual Test Suite
 */
class TestSuite {

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

        //if(!is_subclass_of($this->name, '\Unity\TestSuite')) {
        // TODO HANDLE THIS CASE
        //}

        // Check that the class has methods
        if(($methods = get_class_methods($this->name)) == NULL) {
            return array();
        }

        // Extract test methods
        $testMethods = array_filter($methods,  function($method) {
            return strpos($method, 'test') === 0;
        });

        foreach($testMethods as $method) {
            $name = strtolower(preg_replace('/(?<!^)([A-Z])/', '_\\1', $method));
            $tests[$name] =  $method;
        }

        return $tests;

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
