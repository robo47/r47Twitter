<?php

class Robo47_Http_MockSimpleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers Robo47_Http_MockSimple::__construct
     */
    public function testConstruct()
    {
        $mock = new Robo47_Http_MockSimple('foo');
        $this->assertEquals('foo', $mock->code);
    }
    /**
     * @covers Robo47_Http_MockSimple::fetch
     */
    public function testFetch()
    {
        $mock = new Robo47_Http_MockSimple('foo');
        $this->assertEquals('foo',$mock->fetch('http://example.com'));
        $this->assertEquals('http://example.com',$mock->url);

    }
}
