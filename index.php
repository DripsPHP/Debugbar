<?php

include("vendor/autoload.php");

error_reporting(E_ALL);

//use Drips\Debugger;
use Drips\Debugbar\Debugbar;

Debugbar::on("create", function($bar){
    $bar->registerTab("test", "TestTab", "<h1>Works!</h1>");
    $bar->appendTab("test", "<h1>Works!</h1>");
    $bar->registerTab("test", "TestTab", "<h1>Works!</h1>");
    $bar->registerTab("test2", "2. Tab", "<h1>Works ebenso!</h1>");
    $bar->registerTab("dumper", "Dump it", "<h1>lelelele ebenso!</h1>");
    //$bar->registerTab("dump", "dump", "<h1>lelelele ebenso!</h1>");
    $bar->appendTab("dumper", "<h1>Works!</h1>");
    $bar->registerInfo("currentdate", date("d.m.Y"));
    $bar->registerInfo("currentweek", date("W"));
    $bar->setInfo("currentdate", "neuer name info");
    $bar->setTabTitle("test", "neuer Name");
});

/*
$arr = array(['affe', 13]);
echo dump($arr);
dump("TEAST");
*/


echo Debugbar::getInstance();
