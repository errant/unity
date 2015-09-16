<?
namespace Unity;

use League\Event\Emitter;

/**
 * Unity Core Class
 *
 * @author Tom Morton
 */
class Unity extends Emitter {

    public static function getComposerFile()
    {
        return json_decode(file_get_contents(__DIR__ . '/../composer.json'));
    }

    public function setOutputClass($output)
    {
        $this->writer = $output;
    }

    public function onExecuteCommand($name)
    {
        $this->writer->out('Unity ' . $this->version);
    }

    public function onTestCompleted($name)
    {
        $this->writer->out('Unity ' . $this->version);
    }

    /**
     * OutPut writer
     *
     * @return object Echo/Output Interface
     */
    public function output()
    {
        return $this->writer;
    }


    public function __construct($baseDir, $version)
    {
        $this->baseDir = $baseDir;
        $this->version = $version;

        $this->addListener('command.execute', array($this, 'onExecuteCommand'));
        $this->addListener('test.completed', array($this, 'onTestCompleted'));
    }
}
