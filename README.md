# DebugBar

[![Build Status](https://travis-ci.org/Prowect/Debugbar.svg)](https://travis-ci.org/Prowect/Debugbar)
[![Code Climate](https://codeclimate.com/github/Prowect/Debugbar/badges/gpa.svg)](https://codeclimate.com/github/Prowect/Debugbar)
[![Test Coverage](https://codeclimate.com/github/Prowect/Debugbar/badges/coverage.svg)](https://codeclimate.com/github/Prowect/Debugbar/coverage)


## Beschreibung

Erweiterbare Debugbar zum Debuggen von PHP-Webanwendungen. Zum Hinzufügen von eigenen Funktionen können registerTabs definiert werden (siehe Verwendung).

## Installation

Die Datei `vendor/autoload.php` muss included werden.


## Verwendung

```php
<?php

include("vendor/autoload.php");

use Drips\Debugbar\Debugbar;

Debugbar::on("create", function($bar){
    $bar->registerTab("test", "TestTab", "<h1>Works!</h1>");
    $bar->registerTab("test2", "2. Tab", "<h1>Works ebenso!</h1>");
    $bar->registerInfo("currentdate", date("d.m.Y"));
});
echo Debugbar::getInstance();

```

## Neue Tabs definieren

+ Funktion in Outputbuffer speichern
+ Neue Tabs registrieren

```php
<?php

Debugbar::on("create", function($bar){
    $buffer = new Drips\Utils\Outputbuffer;
    $buffer->start();
    phpinfo();
    $buffer->end();
    $bar->registerTab("phpinfo", "PHP Info", $buffer->getContent());

});
echo Debugbar::getInstance();

```
