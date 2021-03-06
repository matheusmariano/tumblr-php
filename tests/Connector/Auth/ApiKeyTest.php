<?php

use MatheusMariano\Tumblr\Connector\Auth\ApiKey;

class ApiKeyTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->apiKey = new ApiKey('fake');
    }

    public function testInstanceMethod()
    {
        $this->assertEquals('fake', $this->apiKey->consumerKey);
    }

    public function testGetAuth()
    {
        $this->assertSame('', $this->apiKey->getAuth());
    }

    public function testGetHandler()
    {
        $this->assertInstanceOf(
            'GuzzleHttp\HandlerStack',
            $this->apiKey->getHandler()
        );
    }
}
