<?php

/**
 * Test class for yRequest.
 * Generated by PHPUnit on 2011-05-29 at 02:41:30.
 */
class yRequestTest extends PHPUnit_Framework_TestCase{
    /**
     * @var yRequest
     */
    protected $object;
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(){
        
    }
    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(){
        
    }
    public function testSetGetArray(){
        $r = new yRequest;
        $r->setGetArray(array('a'=>'b'));
        $this->assertEquals($r->getGetArg('a'), 'b');
    }
    public function testSetPostArray(){
        $r = new yRequest;
        $r->setPostArray($a = array('a'=>'c'));
        $this->assertEquals($r->getPostArg('a'), 'c');
        $a = array('a'=>'c');
        $r->setPostArray($a);
        $a['a'] = 's';
        $this->assertEquals($r->getPostArg('a'), 's');

        // copy $_POST (do not use reference)
        $r->setPostArray($a = array('a'=>'d'), false);
        $this->assertEquals('d', $r->getPostArg('a'));
        $a = array('a'=>'d');
        $r->setPostArray($a, false);
        $a['a'] = 'e';
        $this->assertEquals('d', $r->getPostArg('a'));
    }
    public function testSetServerArray(){
        $r = new yRequest;
        $r->setServerArray(array('a'=>'d'));
        $this->assertEquals('d', $r->getServerArg('a'));
    }
    public function testGetArg(){
        $r = new yRequest;
        $r->setGetArray(array(
            'get'=>'get',
            'get,post'=>'get',
            'get,server'=>'get'
        ));
        $r->setPostArray($a = array(
            'post'=>'post',
            'get,post'=>'post',
            'post,server'=>'post'
                ), false);
        $r->setServerArray(array(
            'server'=>'server',
            'get,server'=>'server',
            'post,server'=>'server'
        ));
        $this->assertEquals('get', $r->getArg('get'));
        $this->assertEquals('get', $r->getArg('get,server')); // server is not participates
        $this->assertEquals(null, $r->getArg('server')); // server is not participates
        $this->assertEquals('post', $r->getArg('post'));
        $this->assertEquals('post', $r->getArg('get,post')); // $_POST is preferred
    }
    public function testFromEnvironment(){
        $_GET['a'] = 'get';
        $_POST['a'] = 'post';
        $_SERVER['a'] = 'server';
        $r = yRequest::fromEnvironment();
        $this->assertEquals('get', $r->getGetArg('a'));
        $this->assertEquals('post', $r->getPostArg('a'));
        $this->assertEquals('server', $r->getServerArg('a'));
    }
    public function testIsCli(){
        $r = new yRequest;
        $this->assertEquals(true, $r->isCli());
    }
    public function testGetMethod(){
        $r = new yRequest;
        $this->assertEquals(false, $r->isPost());
        $this->assertEquals(false, $r->isGet());
        $this->assertEquals(false, $r->isPut());
        $this->assertEquals(false, $r->isDelete());
        $this->assertEquals(false, $r->isAjax());
        $r->setServerArray(array(
            'REQUEST_METHOD'=>'POST',
        ));
        $this->assertEquals('POST', $r->getMethod());
        $this->assertEquals(true, $r->isPost());
        $r->setServerArray(array(
            'REQUEST_METHOD'=>'GET',
        ));
        $this->assertEquals(true, $r->isGet());
        $r->setServerArray(array(
            'REQUEST_METHOD'=>'PUT',
        ));
        $this->assertEquals(true, $r->isPut());
        $r->setServerArray(array(
            'REQUEST_METHOD'=>'DELETE',
        ));
        $this->assertEquals(true, $r->isDelete());
        $r->setServerArray(array(
            'HTTP_X_REQUESTED_WITH'=>'XMLHttpRequest',
        ));
        $this->assertEquals(true, $r->isAjax());
        $r->setServerArray(array(
            'HTTP_REFERER'=>'http://google.com/',
        ));
        $this->assertEquals('http://google.com/', $r->getReferer());
        $r->setServerArray(array(
            'HTTP_USER_AGENT'=>'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/13.0.772.0 Safari/535.1',
        ));
        $this->assertEquals('Mozilla/5.0 (Windows NT 6.1) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/13.0.772.0 Safari/535.1', $r->getUseragent());
        $r->setServerArray(array(
            'HTTP_HOST'=>'www.google.com',
        ));
        $this->assertEquals('www.google.com', $r->getServerName());
        $this->assertEquals('google.com', $r->getDomainName());
        $r->setServerArray(array(
            'SERVER_NAME'=>'www.google.com',
        ));
        $this->assertEquals('www.google.com', $r->getServerName());
        $this->assertEquals('google.com', $r->getDomainName());
        $r->setServerArray(array(
            'SERVER_NAME'=>'google.com',
        ));
        $this->assertEquals('google.com', $r->getServerName());
        $this->assertEquals('google.com', $r->getDomainName());
        $r->setServerArray(array(
            'SERVER_NAME'=>'user.provider.com',
            'HTTP_HOST'=>'www.google.com',
        ));
        $this->assertEquals('www.google.com', $r->getServerName());
        $this->assertEquals('google.com', $r->getDomainName());
        $r->setServerArray(array(
            'REQUEST_URI'=>'/test?a=b',
        ));
        $this->assertEquals('/test?a=b', $r->getRequestUriString());
        $r->setServerArray(array(
            'DOCUMENT_URI'=>'/test?a=b',
        ));
        $this->assertEquals('/test?a=b', $r->getRequestUriString());
        $r->setServerArray(array(
            'REQUEST_URI'=>'/test?a=c',
            'DOCUMENT_URI'=>'/test?a=b',
        ));
        $this->assertEquals('/test?a=b', $r->getRequestUriString());


        $r->setServerArray(array(
            'REMOTE_ADDR'=>'127.0.0.1',
        ));
        $this->assertEquals('127.0.0.1', $r->getIp());
        $r->setServerArray(array(
            'HTTP_X_FORWARDED_FOR'=>'127.0.0.1',
        ));
        $this->assertEquals('127.0.0.1', $r->getIp());
        $r->setServerArray(array(
            'REMOTE_ADDR'=>'127.0.0.1',
            'HTTP_X_FORWARDED_FOR'=>'192.168.0.1',
        ));
        $this->assertEquals('192.168.0.1', $r->getIp());
        $this->assertEquals('c', $r->getServerParameter('a', 'b', 'c'));
    }
}

