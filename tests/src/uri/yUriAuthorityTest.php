<?php

/**
 * Test class for yUriAuthority.
 * Generated by PHPUnit on 2011-02-18 at 06:49:36.
 */
class yUriAuthorityTest extends PHPUnit_Framework_TestCase{
    /**
     * @var yUriAuthority
     */
    protected $authority;
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(){
        $this->authority = new yUriAuthority;
    }
    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(){
        
    }
    /**
     * @todo Implement testLoadString().
     */
    public function testLoadString(){
        $this->authority->loadString('');
        $this->assertEquals('', strval($this->authority));
        $this->authority->loadString('host');
        $this->assertEquals('//host', strval($this->authority));
        $this->authority->clear();
        $this->assertEquals('', strval($this->authority));
    }
}

