<?php

/**
 * Test class for yUri.
 * Generated by PHPUnit on 2011-02-18 at 05:54:42.
 */
class yUriTest extends PHPUnit_Framework_TestCase{
    /**
     * @var yUri
     */
    protected $uri;
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(){
        $this->uri = new yUri;
    }
    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(){
        
    }
    /**
     * @covers yUri
     */
    public function testLoadString(){
        $this->uri->loadString('http://olamedia.ru/');
        $this->assertEquals('http://olamedia.ru/', strval($this->uri));
        $this->uri->loadString('http://olamedia.ru/path/../to/some?id=3#hash');
        $this->assertEquals('http://olamedia.ru/to/some?id=3#hash', strval($this->uri));
        $this->uri->loadString('//olamedia.ru/path/../to/some?id=3#hash');
        $this->assertEquals('//olamedia.ru/to/some?id=3#hash', strval($this->uri));
        $this->uri->loadString('//olamedia.ru/');
        $this->assertEquals('//olamedia.ru/', strval($this->uri));
        $this->uri->loadString('/path/to');
        $this->assertEquals('/path/to', strval($this->uri));
        $this->uri->loadString('//olamedia.ru');
        $this->assertEquals('//olamedia.ru', strval($this->uri));
        $this->uri->loadString('//olamedia.ru?id=3');
        $this->assertEquals('//olamedia.ru?id=3', strval($this->uri));
        $this->uri = yUri::fromString('http://olamedia.ru/');
        $this->assertEquals('http://olamedia.ru/', strval($this->uri));
        // relative
        $this->uri = yUri::fromString('http://olamedia.ru/page/');
        $rel = $this->uri->getRelativeTo('http://olamedia.ru/');
        $this->assertEquals('page/', strval($rel));

        $this->uri = yUri::fromString('http://olamedia.ru/page/to');
        $rel = $this->uri->getRelativeTo('http://olamedia.ru/');
        $this->assertEquals('page/to', strval($rel));

        $this->uri = yUri::fromString('http://olamedia.ru/page/to?id=3#hash');
        $rel = $this->uri->getRelativeTo('http://olamedia.ru/');
        $this->assertEquals('page/to?id=3#hash', strval($rel));

        $this->uri = yUri::fromString('http://olamedia.ru/page/to?id=3');
        $rel = $this->uri->getRelativeTo('http://olamedia.ru');
        $this->assertEquals('page/to?id=3', strval($rel));
        $this->uri = yUri::fromString('http://olamedia.ru/page/to?id=3');
        $rel = $this->uri->getRelativeTo('http://test.olamedia.ru');
        $this->assertEquals('//olamedia.ru/page/to?id=3', strval($rel));
        // clone test
        $this->uri = yUri::fromString('http://olamedia.ru/page/to?id=3');
        $rel = $this->uri->getRelativeTo('http://olamedia.ru');
        $this->assertEquals('page/to?id=3', strval($rel));
        $rel = $this->uri->getRelativeTo('http://test.olamedia.ru');
        $this->assertEquals('//olamedia.ru/page/to?id=3', strval($rel));
    }
}


