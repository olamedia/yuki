<?php

/**
 * Test class for yModelCollection.
 * Generated by PHPUnit on 2011-07-23 at 13:54:12.
 */
class yModelCollectionTest extends PHPUnit_Framework_TestCase{
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
    public function testGetClass(){
        $posts = new yModelCollection('post');
        $this->assertEquals('post', $posts->getClass());
    }
    public function test__get(){
        $posts = new yModelCollection('post');
        $this->assertEquals('yModelField', get_class($posts->id));
    }
    /**
     * @todo Implement test__set().
     */
    public function test__set(){
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
                'This test has not been implemented yet.'
        );
    }
}

?>