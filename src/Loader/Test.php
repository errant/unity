<?
namespace Unity\Loader;
use Symfony\Component\Finder\Finder;
/**
 * Load an Individual Test
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
        $write = $this->unity->output();
        $write->inline($this->getName())
              ->tab();

        $size = $this->getSize();
        if($size == '>5MB') {
            $write->red()->inline($size)->tab();
        } else {
            $write->red()->inline($size)->tab();
        }

        $write->inline('tests');
        $write->break();
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

        return array_filter(get_class_methods($this->name),  );
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
