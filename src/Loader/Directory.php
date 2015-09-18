<?
namespace Unity\Loader;
use Symfony\Component\Finder\Finder;
/**
 * Loads a Folder of Tests
 */
class Directory {

    protected $tests = array();

    public function __construct($unity, $directory)
    {
        $this->unity = $unity;

        $finder = new Finder();

        if(!is_dir($directory)) {
            throw new \Exception('Unable to access directory: ' . $directory);
        }

        $this->directory = $finder
                              ->files()
                              ->name('*Tests.php')
                              ->in($directory);

        foreach($this->directory as $testFile) {
            $this->tests[] = new \Unity\Loader\TestSuite($this->unity, $testFile);
        }
    }

    public function getTests()
    {
        return $this->tests;
    }
}
