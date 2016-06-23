# DebugBar

[![Build Status](https://travis-ci.org/Prowect/Debugbar.svg)](https://travis-ci.org/Prowect/Debugbar)
[![Code Climate](https://codeclimate.com/github/Prowect/Debugbar/badges/gpa.svg)](https://codeclimate.com/github/Prowect/Debugbar)
[![Test Coverage](https://codeclimate.com/github/Prowect/Debugbar/badges/coverage.svg)](https://codeclimate.com/github/Prowect/Debugbar/coverage)


## Beschreibung

Erweiterbare Debugbar zum Debuggen von PHP-Webanwendungen. Zum Hinzufügen von eigenen Funktionen können registerTabs definiert werden.

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


Die Ausgabe muss als String übergeben werden.


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
> erzeugt neuen Tab PHP Info


```php
<?php

Debugbar::on("create", function($bar){
    $bar->registerInfo("currentdate", date("d.m.Y"));
    $bar->registerInfo("currentweek", date("W"));
});

echo Debugbar::getInstance();
```

> erzeugt neuen Tab mit aktuellem Datum

```php
<?php

Debugbar::on("create", function($bar){
    $bar->registerTab("test", "TestTab", "<h1>Works!</h1>");
    $bar->appendTab("test", "<h1>Works!</h1>");
    $bar->registerTab("test", "TestTab", "<h1>Works!</h1>");
    $bar->registerTab("test2", "2. Tab", "<h1>Works ebenso!</h1>");
    $bar->registerInfo("currentdate", date("d.m.Y"));
    $bar->registerInfo("currentweek", date("W"));
});

echo Debugbar::getInstance();
```
> appendTab: Inhalt wird an bestehende Tabs angehängt


## Tabs umbenennen
```php
<?php

Debugbar::on("create", function($bar){
    $bar->setTabTitle("test", "neuer Name");
});

echo Debugbar::getInstance();
```
> ändert den Titel auf "neuer Name"



## Info umbenennen
```php
<?php

Debugbar::on("create", function($bar){
    $bar->setInfo("currentdate", "neuer Name Info");
});

echo Debugbar::getInstance();
```
> ändert den Titel auf "neuer Name Info"


## Tabs überprüfen
```php
<?php

Debugbar::on("create", function($bar){
    $bar->getTabs();
});

echo Debugbar::getInstance();
```
>  gibt alle Tabs zurück



```php
<?php

Debugbar::on("create", function($bar){
    getTabTitle($name)
});

echo Debugbar::getInstance();
```
>  überprüft, ob der Tab bereits existiert und gibt den Namen zurück



```php
<?php

Debugbar::on("create", function($bar){
    getTabContent($name)
});

echo Debugbar::getInstance();
```
>  überprüft, ob der Tab bereits existiert und gibt den Inhalt zurück



## Infos überprüfen
```php
<?php

Debugbar::on("create", function($bar){
    $bar->getInfos();
});

echo Debugbar::getInstance();
```
>  gibt alle Infos zurück


```php
<?php

Debugbar::on("create", function($bar){
    $bar->getInfo();
});

echo Debugbar::getInstance();
```
>  überprüft, ob Info bereits existiert und gibt den Namen zurück
