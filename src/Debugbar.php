<?php

namespace Drips\Debugbar;

use Drips\Utils\Event;
use Drips\Utils\OutputBuffer;

class Debugbar extends Event
{
    const TITLE = "title";
    const CONTENT = "content";
    private static $instance;
    protected $tabs = array();
    protected $infos = array();

    private function __construct(){}

    private function __clone(){}

    public static function getInstance()
    {
        if(static::$instance === null){
            static::$instance = new static;
            static::call("create", static::$instance);
        }

        return static::$instance;
    }

    public function __toString()
    {
        $buffer = new OutputBuffer;
        $buffer->start();
        include(__DIR__."/layout.phtml");
        return $buffer->end();
    }

    public function registerTab($name, $title, $content)
    {
        $this->tabs[$name] = array(static::TITLE => $title, static::CONTENT => $content);
    }

    public function registerInfo($name, $info)
    {
        $this->infos[$name] = $info;
    }

    public function getTabs()
    {
        return $this->tabs;
    }

    public function getInfos()
    {
        return $this->infos;
    }
}
