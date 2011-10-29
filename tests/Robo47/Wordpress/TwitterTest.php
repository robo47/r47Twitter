<?php

class Robo47_Wordpress_TwitterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers Robo47_Wordpress_Twitter::__construct
     * @covers Robo47_Wordpress_Twitter::setAccount
     * @covers Robo47_Wordpress_Twitter::getAccount
     * @covers Robo47_Wordpress_Twitter::setHttp
     * @covers Robo47_Wordpress_Twitter::getHttp
     */
    public function test__construct()
    {
        $twitter = new Robo47_Wordpress_Twitter('robo47');
        $this->assertEquals('robo47', $twitter->getAccount());
        $this->assertInstanceOf('Robo47_Http_Curl', $twitter->getHttp());
    }
    /**
     * @covers Robo47_Wordpress_Twitter::__construct
     * @covers Robo47_Wordpress_Twitter::setAccount
     * @covers Robo47_Wordpress_Twitter::getAccount
     * @covers Robo47_Wordpress_Twitter::setHttp
     * @covers Robo47_Wordpress_Twitter::getHttp
     */
    public function test__constructWithHttp()
    {
        $http = new Robo47_Http_MockSimple();
        $twitter = new Robo47_Wordpress_Twitter('robo47', $http);
        $this->assertEquals('robo47', $twitter->getAccount());
    }
    
    /**
     * @covers  Robo47_Wordpress_Twitter::fetchTweets
     */
    public function testFetchTweets()
    {
        $http = new Robo47_Http_MockSimple(file_get_contents(dirname(__FILE__) . '/fixtures/twitter-response.json'));
        $twitter = new Robo47_Wordpress_Twitter('robo47', $http);
        $this->markTestIncomplete('not implemented yet');
    }
}