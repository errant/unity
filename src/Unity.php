<?
namespace Unity;


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
    }

    public function getVersion()
    {
        return $this->version;
    }
}
