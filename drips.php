<?php

use Drips\App;
use Drips\HTTP\Request;
use Drips\Debugbar\Debugbar;

if(class_exists('Drips\App')){
    App::on('shutdown', function(){
        if(in_array("text/html", (new Request)->getAccept())){
            $debugbar = Debugbar::getInstance();
            if(!empty($debugbar->getTabs())){
                echo $debugbar;
            }
        }
    });
}
