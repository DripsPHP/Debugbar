<?php

use Drips\App;
use Drips\HTTP\Request;
use Drips\Debugbar\Debugbar;

if(!defined('DRIPS_DEBUG')){
    define('DRIPS_DEBUG', true);
}

if(class_exists('Drips\App')){
    App::on('shutdown', function(){
	$request = Request::getInstance();
        if(in_array("text/html", $request->getAccept())){
            $debugbar = Debugbar::getInstance();
            if($debugbar->hasTabs()){
                echo $debugbar;
            }
        }
    });
}
