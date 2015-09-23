<?
namespace Unity;

class Stack {

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
