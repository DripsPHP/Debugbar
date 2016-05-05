<?php

namespace tests;

use Drips\Debugbar\Debugbar;
use PHPUnit_Framework_TestCase;

class DebugbarTest extends PHPUnit_Framework_TestCase
{
    public function testDebugbar()
    {
        Debugbar::on("create", function($debugbar){
            echo "Debugbar created";
            $this->assertTrue(true);
        });

        echo "Creating debugbar!";
        echo Debugbar::getInstance();
    }
}
