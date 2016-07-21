<?php

use Drips\HTTP\Request;
use Drips\HTTP\Response;
use Drips\Debugbar\Debugbar;

if(!defined('DRIPS_DEBUG')){
    define('DRIPS_DEBUG', true);
}

if(class_exists('Drips\App')){
    Response::on('send', function($response){
	    $request = Request::getInstance();
        if(in_array('text/html', $request->getAccept())){
            $debugbar = Debugbar::getInstance();
            if($debugbar->hasTabs()){
                $debugbarString = $debugbar->__toString();
                $reponse->body = str_replace('</body>', $debugbarString.'</body>', $response->body);
            }
        }
    });
}
