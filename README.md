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

Debugbar::on("create", function($debugbar){
    $debugbar->registerTab("test", "TestTab", "<h1>Works!</h1>");
    $debugbar->registerTab("test2", "2. Tab", "<h1>Works ebenso!</h1>");
    $debugbar->registerInfo("currentdate", date("d.m.Y"));
});
echo Debugbar::getInstance();

```

## Neue Tabs definieren


Die Ausgabe muss als String übergeben werden.


```php
<?php

Debugbar::on("create", function($debugbar){
    $buffer = new Drips\Utils\Outputbuffer;
    $buffer->start();
    phpinfo();
    $buffer->end();
    $debugbar->registerTab("phpinfo", "PHP Info", $buffer->getContent());

});
echo Debugbar::getInstance();

```
> erzeugt neuen Tab PHP Info


```php
<?php

Debugbar::on("create", function($debugbar){
    $debugbar->registerInfo("currentdate", date("d.m.Y"));
    $debugbar->registerInfo("currentweek", date("W"));
});

echo Debugbar::getInstance();
```

> erzeugt neuen Tab mit aktuellem Datum

```php
<?php

Debugbar::on("create", function($debugbar){
    $debugbar->registerTab("test", "TestTab", "<h1>Works!</h1>");
    $debugbar->appendTab("test", "<h1>Works!</h1>");
    $debugbar->registerTab("test", "TestTab", "<h1>Works!</h1>");
    $debugbar->registerTab("test2", "2. Tab", "<h1>Works ebenso!</h1>");
    $debugbar->registerInfo("currentdate", date("d.m.Y"));
    $debugbar->registerInfo("currentweek", date("W"));
});

echo Debugbar::getInstance();
```
> appendTab: Inhalt wird an bestehende Tabs angehängt


## Tabs umbenennen
```php
<?php

    $debugbar->setTabTitle("test", "neuer Name");

```
> ändert den Titel auf "neuer Name"



## Info umbenennen
```php
<?php

    $debugbar->setInfo("currentdate", "neuer Name Info");
```
> ändert den Titel auf "neuer Name Info"


## Tabs überprüfen
```php
<?php

    $tabs = $debugbar->getTabs();
    foreach($tabs as $tab){
        var_dump($tab);
    }
```
>  gibt alle registrierten Tabs aus



```php
<?php

$tab = $debugbar->getTabTitle("test");
var_dump($tab);
```
>  überprüft, ob der Tab bereits registriert wurde und gibt den Namen aus


```php
<?php

$tab = $debugbar->getTabContent("test");
var_dump($tab);

```
>  überprüft, ob der Tab bereits registriert wurde und gibt den Inhalt aus


```php
<?php

if($debugbar->hasTabs()){
 // Es sind bereits Tabs registriert
} else {
 // Es sind noch keine Tabs registriert
}
```
>  Überprüft, ob bereits Tabs registriert wurden

```php
<?php

if($debugbar->hasTab($name)){
 // Dieser Tab wurde bereits registriert
} else {
 // Dieser Tab wurde noch nicht registriert
}
```
>  überprüft, ob ausgewählter Tab bereits registriert wurde






## Infos überprüfen
```php
<?php

$infos = $debugbar->getInfos();
foreach($infos as $info){
    var_dump($info);
}
```
>  gibt alle registrieren Infos aus


```php
<?php
$info = $debugbar->getInfo("currentdate");
var_dump($info);
```
>  überprüft, ob Info bereits registriert wurde und gibt den Namen aus



```php
<?php

if($debugbar->hasInfo($name)){
 // Diese Info wurde bereits registriert
} else {
 // Diese Info wurde noch nicht registriert
}
```
>  Überprüft, ob ausgewählter Info bereits registriert wurde


```php
<?php
if($debugbar->hasInfos()){
 // Es sind bereits Infos registriert
} else {
 // Es sind noch keine Infos registriert
}
```
>  Überprüft, ob bereits Infos registriert wurden
