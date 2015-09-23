<?
namespace Unity;

use Unity\Test\TestInterface;

/**
 * Unity Core Class
 *
 * @author Tom Morton
 */
class Unity extends Container {

    /**
     * [getComposerFile description]
     * @return [type] [description]
     */
    public static function getComposerFile()
    {
        return json_decode(file_get_contents(__DIR__ . '/../composer.json'));
    }

    public function __construct($baseDir, $version)
    {
        $this->baseDir = $baseDir;
        $this->version = $version;

        // The Test Stack, a core aspect of Unity
        Stack::register();
    }

    // Getters

    public function getVersion()
    {
        return $this->version;
    }

    // Stack

    /**
     * Pushes Test To Stack
     *
     * @param  TestInterface $test Test Object
     */
    public function pushTest(TestInterface $test)
    {
        $this->stack->push($test);
    }
}
