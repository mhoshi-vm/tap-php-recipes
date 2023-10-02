<?php

use PHPUnit\Framework\TestCase;

class HelloWorldTest extends TestCase
{
    protected $HelloWorld;

    public function setUp(): void
    {
        $this->HelloWorld = new tappoc\HelloWorld();
    }

    public function testNoInput(){
        $this->assertEquals("Hello World!", $this->HelloWorld->respond(""));
    }

    public function testInput(){
        $this->assertEquals("Hello TAP", $this->HelloWorld->respond("TAP"));
    }
}