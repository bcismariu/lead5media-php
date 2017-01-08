# Lead5Media Syndicated Job Feed API in PHP

[![Build Status](https://travis-ci.org/bcismariu/lead5media-php.svg?branch=master)](https://travis-ci.org/bcismariu/lead5media-php)
[![Latest Stable Version](https://poser.pugx.org/bcismariu/lead5media-php/v/stable)](https://packagist.org/packages/bcismariu/lead5media-php)
[![License](https://poser.pugx.org/bcismariu/lead5media-php/license)](https://packagist.org/packages/bcismariu/lead5media-php)
[![Total Downloads](https://poser.pugx.org/bcismariu/lead5media-php/downloads)](https://packagist.org/packages/bcismariu/lead5media-php)

### Installation
Update your `composer.json` file
```json
{
    "require": {
        "bcismariu/lead5media-php": "0.*"
    }
}
```
Run `composer update`

### Usage
```php
use Bcismariu\Lead5Media\Lead5Media;

$jobs = new Lead5Media('CID');
$jobs->setQuery('Warehouse Worker')
     ->setLocation('31131')
     ->get();
```

### Contributions

This is a very basic implementation that can only handle basic calls. Any project contributions are welcomed!
