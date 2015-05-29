Rapid Application Development : Prototype
====================================
Simply handle password encryption and salt generation

[![Build Status](https://travis-ci.org/KnpLabs/rad-prototype.svg?branch=master)](https://travis-ci.org/KnpLabs/rad-prototype)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/KnpLabs/rad-prototype/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/KnpLabs/rad-prototype/?branch=master)

#Installation

```bash
composer require knplabs/rad-prototype ~1.0
```

```php
class AppKernel
{
    function registerBundles()
    {
        $bundles = array(
            //...
            new Knp\Rad\Prototype\Bundle\PrototypeBundle(),
            //...
        );

        //...

        return $bundles;
    }
}
```

#Usages

