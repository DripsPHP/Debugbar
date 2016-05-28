<?php

use Drips\App;
use Drips\HTTP\Request;
use Drips\Debugbar\Debugbar;

if(!defined('DRIPS_DEBUG')){
    define('DRIPS_DEBUG', true);
}

if(class_exists('Drips\App')){
    App::on('shutdown', function(){
        if(in_array("text/html", (new Request)->getAccept())){
            $debugbar = Debugbar::getInstance();
            $tabs = $debugbar->getTabs();
            if(!empty($tabs)){
                echo $debugbar;
            }
        }
    });
}
