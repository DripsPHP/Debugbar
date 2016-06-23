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

    $bar->setTabTitle("test", "neuer Name");

```
> ändert den Titel auf "neuer Name"



## Info umbenennen
```php
<?php

    $bar->setInfo("currentdate", "neuer Name Info");
```
> ändert den Titel auf "neuer Name Info"


## Tabs überprüfen
```php
<?php

    $bar->getTabs();
```
>  gibt alle Tabs zurück



```php
<?php

    $bar->getTabTitle($name)
```
>  überprüft, ob der Tab bereits existiert und gibt den Namen zurück


```php
<?php

    $bar->getTabContent($name)
```
>  überprüft, ob der Tab bereits existiert und gibt den Inhalt zurück


```php
<?php

    $bar->hasTabs()
```
>  gibt true zurück, wenn der Tab bereits existiert

```php
<?php

    $bar->hasTab($name)
```
>  gibt true zurück, wenn der Name des Tabs bereits existiert







## Infos überprüfen
```php
<?php

    $bar->getInfos();
```
>  gibt alle Infos zurück


```php
<?php

    $bar->getInfo();
```
>  überprüft, ob Info bereits existiert und gibt den Namen zurück



```php
<?php

    $bar->hasInfo($name);
```
>  gibt true zurück, wenn der Name bereits existiert


```php
<?php

    $bar->hasInfos();
```
>  gibt true zurück, wenn Info bereits existiert
