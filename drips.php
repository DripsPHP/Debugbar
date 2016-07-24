<?php

use Drips\Debugbar\Debugbar;
use Drips\HTTP\Request;
use Drips\HTTP\Response;

if (!defined('DRIPS_DEBUG')) {
    define('DRIPS_DEBUG', true);
}

if (class_exists('Drips\App')) {
    Response::on('send', function ($response) {
        $request = Request::getInstance();
        if (in_array('text/html', $request->getAccept())) {
            $debugbar = Debugbar::getInstance();
            if ($debugbar->hasTabs()) {
                $debugbarString = $debugbar->__toString();
                $bodyTag = '</body>';
                if (strpos($response->body, $bodyTag) !== false) {
                    $response->body = str_replace($bodyTag, $debugbarString . $bodyTag, $response->body);
                } else {
                    $response->body .= $debugbarString;
                }
            }
        }
    });
}
