<?php

namespace tests;

use Drips\Debugbar\Debugbar;
use PHPUnit_Framework_TestCase;

class DebugbarTest extends PHPUnit_Framework_TestCase
{
    public function testDebugbar()
    {
        Debugbar::on("create", function ($debugbar) {
            echo "Debugbar created";
            $this->assertTrue(true);
            $this->assertFalse($debugbar->hasInfo('test'));
            $debugbar->registerInfo("test", "<h1>Works!</h1>");
            $this->assertTrue($debugbar->hasInfo('test'));
            $this->assertEquals("<h1>Works!</h1>", $debugbar->getInfo('test'));
            $debugbar->setInfo("test", "<h2>Works!</h2>");
            $this->assertEquals("<h2>Works!</h2>", $debugbar->getInfo('test'));
            $this->assertFalse($debugbar->hasTab('test'));
            $debugbar->registerTab("test", "<h1>Works!</h1>", "content");
            $this->assertTrue($debugbar->hasTab('test'));
            $this->assertEquals("<h1>Works!</h1>", $debugbar->getTabTitle('test'));
            $this->assertEquals("content", $debugbar->getTabContent('test'));
        });

        echo "Creating debugbar!";
        echo Debugbar::getInstance();
    }

}
