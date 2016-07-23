<?php

namespace Drips\Debugbar;

use Drips\Utils\Event;
use Drips\Utils\OutputBuffer;


/**
 * Class Debugbar.
 *
 * Erweiterbare Debugbar zum Debuggen von PHP Webanwendungen
 */
class Debugbar
{
    use Event;
    
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

    /**
     * speichert die Ausgabe
     *
     * @return mixed
     */
    public function __toString()
    {
        $buffer = new OutputBuffer;
        $buffer->start();
        include(__DIR__."/layout.phtml");
        return $buffer->end();
    }

    /**
     * neue Tabs registrieren
     *
     * @param string $name
     * @param string $title
     * @param string content
     *
     */
    public function registerTab($name, $title, $content='')
    {
        $this->tabs[$name] = array(static::TITLE => $title, static::CONTENT => $content);
    }

    /**
     * erweitert bestehenden Tab
     * @param string $name
     * @param string $content
     */
    public function appendTab($name, $content){
      if(array_key_exists($name, $this->tabs)){
        $this->tabs[$name][static::CONTENT].=$content;
        return true;
      }
      return false;
    }

    /**
     * neue Info registrieren
     *
     * @param string $name
     * @param string $info
     */
    public function registerInfo($name, $info)
    {
        $this->infos[$name] = $info;
    }

    /**
     * alle registrierten Tabs
     *
     * @return array
     */
    public function getTabs()
    {
        return $this->tabs;
    }

    /**
     * alle registrierten Infos
     *
     * @return array
     */
    public function getInfos()
    {
        return $this->infos;
    }

    /**
     * prüft ob Infos registriert wurden
     *
     * @return bool
     */
    public function hasInfos(){
        return !empty($this->infos);
    }

    /**
     * benennt Info um
     *
     * @param string $name
     * @param string $new_name
     */
    public function setInfo($name, $new_name){
        $this->registerInfo($name, $new_name);
    }

    /**
     * ändert Namen vom Tab
     *
     * @param string $name
     * @param string $new_name
     */
    public function setTabTitle($name, $new_name){
        if($this->hasTab($name)){
            $this->tabs[$name][static::TITLE] = $new_name;
        }
    }

    /**
     * prüft ob Info registriert wurde, gibt den Namen zurück
     *
     * @param string $name
     * @return mixed
     */
    public function getInfo($name){
        if($this->hasInfo($name)){
            return $this->infos[$name];
        }
    }

    /**
     * prüft ob Infos registriert wurden
     *
     * @param string $name
     * @return bool
     */
    public function hasInfo($name){
        return isset($this->infos[$name]);
    }

    /**
     * prüft, ob der Tab bereits registriert wurde
     *
     * @param string $name
     * @return bool
     */
    public function hasTab($name){
        return isset($this->tabs[$name]);
    }

    /**
     * prüft ob bereits Tabs registriert wurden
     *
     * @return bool
     */
    public function hasTabs(){
        return !empty($this->tabs);
    }

    /**
     * prüft ob Tab registriert wurde und gibt Namen zurück
     *
     * @param string $name
     * @return mixed
     */
    public function getTabTitle($name){
        if($this->hasTab($name)){
            return $this->tabs[$name][static::TITLE];
        }
    }

    /**
     * püft ob Tab registriert wurde und gibt Inhalt zurück
     *
     * @param int $name
     * @return mixed
     */
    public function getTabContent($name){
        if($this->hasTab($name)){
            return $this->tabs[$name][static::CONTENT];
        }
    }
}
