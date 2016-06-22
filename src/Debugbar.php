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

    public function registerTab($name, $title, $content='')
    {
        $this->tabs[$name] = array(static::TITLE => $title, static::CONTENT => $content);
    }

    public function appendTab($name, $content){
      if(array_key_exists($name, $this->tabs)){
        $this->tabs[$name][static::CONTENT].=$content;
        return true;
      }
      return false;
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

    public function hasInfos(){
        return !empty($this->infos);
    }

    public function setInfo($name, $new_name){
        $this->registerInfo($name, $new_name);
    }

    public function setTabTitle($name, $new_name){
        if($this->hasTab($name)){
            $this->tabs[$name][static::TITLE] = $new_name;
        }
    }

    public function getInfo($name){
        if($this->hasInfo($name)){
            return $this->infos[$name];
        }
    }

    public function hasInfo($name){
        return isset($this->infos[$name]);
    }

    public function hasTab($name){
        return isset($this->tabs[$name]);
    }

    public function hasTabs(){
        return !empty($this->tabs);
    }

    public function getTabTitle($name){
        if($this->hasTab($name)){
            return $this->tabs[$name][static::TITLE];
        }
    }

    public function getTabContent($name){
        if($this->hasTab($name)){
            return $this->tabs[$name][static::CONTENT];
        }
    }
}
