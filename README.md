To use Composer PSR-0 / PSR-4 class autoloading in RBS Change 3.6.x, follow these 2 steps :

1. Use the Framework.php file provided in this repo (suitable for RBS Change 3.6.8) or add these few lines in yours arround line 479, before configuration loading :

```php
// Composer PSR-0/4 Autoloader
$autoloaderPath = WEBEDIT_HOME . '/libs/autoload.php';
if (file_exists($autoloaderPath)) {
	require_once $autoloaderPath;
}
```

2. Create a composer.json file at the root of your project with the following content :

```json
{
    "config": {
        "vendor-dir": "libs/"
    }
}
```

**That's it, you're done !**

You can now add dependencies among any PSR-0/4 compliant library by requiring it in your `composer.json`.