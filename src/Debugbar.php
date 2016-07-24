<?php

namespace Drips\Debugbar;

use Drips\Utils\Event;
use Drips\Utils\OutputBuffer;

/**
 * Class Debugbar.
 *
 * Erweiterbare Debugbar zum Debuggen von PHP Webanwendungen
 *
 * @package Drips/Debugbar
 */
class Debugbar
{
    use Event;

    /**
     * Legt fest, dass es sich beim Registrieren eines Tabs um den TITLE des Tabs handelt
     */
    const TITLE = "title";

    /**
     * Legt fest, dass es sich beim Registrieren eines Tabs um den CONTENT des Tabs handelt
     */
    const CONTENT = "content";

    /**
     * Beinhaltet die Debugbar-Instanz (Singleton)
     *
     * @var Debugbar
     */
    private static $instance;

    /**
     * Beinhaltet alle registrierten Tabs
     *
     * @var array
     */
    protected $tabs = array();

    /**
     * Beinhaltet alle registrierten Infos
     *
     * @var array
     */
    protected $infos = array();

    private function __construct() {}

    private function __clone() {}

    /**
     * Liefert die Singleton-Instanz (Objekt) zurück.
     *
     * @return Debugbar
     */
    public static function getInstance()
    {
        if (static::$instance === null) {
            static::$instance = new static;
            static::call("create", static::$instance);
        }

        return static::$instance;
    }

    /**
     * Erzeugt die Debugbar und liefert den HTML-Code als String zurück.
     *
     * @return string
     */
    public function __toString()
    {
        $buffer = new OutputBuffer;
        $buffer->start();
        include(__DIR__ . "/layout.phtml");
        return $buffer->end();
    }

    /**
     * Zum Registrieren neuer Tabs.
     *
     * @param string $name
     * @param string $title
     * @param string $content
     *
     */
    public function registerTab($name, $title, $content = '')
    {
        $this->tabs[$name] = array(static::TITLE => $title, static::CONTENT => $content);
    }

    /**
     * Erweitert (appended) den Inhalt (Content) eines bestehenden Tabs.
     *
     * @param string $name
     * @param string $content
     *
     * @return bool
     */
    public function appendTab($name, $content)
    {
        if (array_key_exists($name, $this->tabs)) {
            $this->tabs[$name][static::CONTENT] .= $content;
            return true;
        }
        return false;
    }

    /**
     * Zum Registrieren neuer Infos.
     *
     * @param string $name
     * @param string $info
     */
    public function registerInfo($name, $info)
    {
        $this->infos[$name] = $info;
    }

    /**
     * Liefert alle registrierten Tabs als Array zurück. Der Titel und der Inhalt können mithilfe der definierten Konstanten
     * ausgelesen werden - entsprechen den Array-Keys.
     *
     * @return array
     */
    public function getTabs()
    {
        return $this->tabs;
    }

    /**
     * Liefert alle registrierten Infos als Array zurück.
     *
     * @return array
     */
    public function getInfos()
    {
        return $this->infos;
    }

    /**
     * Prüft ob bereits Infos registriert wurden.
     *
     * @return bool
     */
    public function hasInfos()
    {
        return !empty($this->infos);
    }

    /**
     * Setzt oder überschreibt eine Info.
     *
     * @param string $name
     * @param string $new_name
     */
    public function setInfo($name, $new_name)
    {
        $this->registerInfo($name, $new_name);
    }

    /**
     * Zum ändern des Titels eines bestehenden Tabs.
     *
     * @param string $name
     * @param string $new_name
     */
    public function setTabTitle($name, $new_name)
    {
        if ($this->hasTab($name)) {
            $this->tabs[$name][static::TITLE] = $new_name;
        }
    }

    /**
     * Liefert den Inhalt einer Info zurück, wenn diese registriert wurde.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function getInfo($name)
    {
        if ($this->hasInfo($name)) {
            return $this->infos[$name];
        }
    }

    /**
     * Prüft ob eine bestimmte Info registriert wurde.
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasInfo($name)
    {
        return isset($this->infos[$name]);
    }

    /**
     * Prüft, ob der Tab bereits registriert wurde.
     *
     * @param string $name
     *
     * @return bool
     */
    public function hasTab($name)
    {
        return isset($this->tabs[$name]);
    }

    /**
     * Prüft ob bereits Tabs registriert wurden.
     *
     * @return bool
     */
    public function hasTabs()
    {
        return !empty($this->tabs);
    }

    /**
     * Liefert den Titel eines bestehenden Tabs zurück, wenn dieser existiert.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function getTabTitle($name)
    {
        if ($this->hasTab($name)) {
            return $this->tabs[$name][static::TITLE];
        }
    }

    /**
     * Liefert den Titel eines bestehenden Tabs zurück, wenn dieser existiert.
     *
     * @param int $name
     *
     * @return mixed
     */
    public function getTabContent($name)
    {
        if ($this->hasTab($name)) {
            return $this->tabs[$name][static::CONTENT];
        }
    }
}
