<?
namespace Unity;

use Unity\Container\ServiceTrait;
use Unity\Container\ServiceInterface;

/**
 * Unity Test Stack
 *
 * The test stack is the core of Unity's Test Runner
 *
 * Tests are processed from the stack
 */
class Stack implements ServiceInterface {
    use ServiceTrait;

    protected $testsStack;

    public function push($test)
    {
        $this->testsStack[] = $test;
    }

    public function run()
    {
        foreach($this->testStack() as $test) {
            yield $test;
        }
    }
}
