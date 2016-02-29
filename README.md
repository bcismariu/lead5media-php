# Lead5Media Syndicated Job Feed API in PHP

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
