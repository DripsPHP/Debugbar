<?php

include("vendor/autoload.php");

use Drips\Debugbar\Debugbar;

Debugbar::on("create", function($bar){
    $bar->registerTab("test", "TestTab", "<h1>Works!</h1>");
    $bar->registerTab("test2", "2. Tab", "<h1>Works ebenso!</h1>");
    $bar->registerInfo("currentdate", date("d.m.Y"));
    $bar->registerInfo("currentweek", date("W"));
});

echo Debugbar::getInstance();
