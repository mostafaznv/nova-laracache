# Nova LaraCache

[![GitHub license](https://img.shields.io/github/license/mostafaznv/nova-laracache?style=flat-square)](https://github.com/mostafaznv/nova-laracache/blob/master/LICENSE)
[![Packagist Downloads](https://img.shields.io/packagist/dt/mostafaznv/nova-laracache?style=flat-square&logo=packagist)](https://packagist.org/packages/mostafaznv/nova-laracache)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/mostafaznv/nova-laracache.svg?style=flat-square&logo=composer)](https://packagist.org/packages/mostafaznv/nova-laracache)

Nova LaraCache is a robust Laravel Nova package that facilitates the seamless integration of the [LaraCache](https://github.com/mostafaznv/laracache) package with the Laravel Nova. With Nova LaraCache, users gain a powerful cache management tool within the familiar Laravel Nova interface.

This package extends the capabilities of LaraCache, offering a comprehensive set of tools to efficiently moderate and manage cache entities. Users can effortlessly monitor cache expiration dates, ensuring the freshness and accuracy of cached data. By reviewing cache entity contents, users can gain insights into the stored data and its relevance. Nova LaraCache also enables users to regenerate cache items, facilitating updates and refreshes of cached entities. Additionally, users have the flexibility to delete specific cache entries, providing control over cache management tasks.

With Nova LaraCache, users can take full advantage of cache management capabilities directly within the Laravel Nova environment. By offering an intuitive interface and seamless integration, Nova LaraCache enables users to efficiently moderate and manage cache entities, ultimately contributing to the performance and efficiency of their Laravel applications.

----
I am on an open-source journey 🚀, and I wish I could solely focus on my development path without worrying about my financial situation. However, as life is not perfect, I have to consider other factors.

Therefore, if you decide to use my packages, please kindly consider making a donation. Any amount, no matter how small, goes a long way and is greatly appreciated. 🍺

[![Donate](https://mostafaznv.github.io/donate/donate.svg)](https://mostafaznv.github.io/donate)

----

## Requirements:

- PHP 8.1 or higher
- LaraCache 2.3.2 or higher
- Laravel 10.4.1 or higher
- Nova 4.*


## Installation
> **Note** Ensure that you have already installed and configured the LaraCache package in your Laravel application. If you haven't done so, please refer to the LaraCache [documentation](https://github.com/mostafaznv/laracache) for instructions on installation and usage. **It's important to create cache entities for each model before proceeding with Nova LaraCache.**

To get started, you will need to install the following dependency:

```shell
composer require mostafaznv/nova-laracache
```
That's it, you're ready to go!

## Usage
After the package installation is complete, register the Nova LaraCache tool within your Laravel Nova application. Open the `NovaServiceProvider` class located at `app/Providers/NovaServiceProvider.php` and add the following line to the tools() method:

```php
<?php

namespace App\Providers;

use Laravel\Nova\NovaApplicationServiceProvider;
use Mostafaznv\NovaLaraCache\NovaLaraCache;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    public function tools(): array
    {
        return [
            new NovaLaraCache
        ];
    }
}
```
Done! just navigate to your Laravel Nova panel. You should now see the LaraCache tool integrated into the sidebar.

**Remember**, before using Nova LaraCache, ensure that you have followed the instructions in the LaraCache [documentation](https://github.com/mostafaznv/laracache) to create cache entities for each model. This will ensure that you have the necessary cache setup in place for effective cache management using Nova LaraCache.


https://github.com/mostafaznv/nova-laracache/assets/7619687/91bb08dd-0404-4b35-add4-4437486d2110

----
I am on an open-source journey 🚀, and I wish I could solely focus on my development path without worrying about my financial situation. However, as life is not perfect, I have to consider other factors.

Therefore, if you decide to use my packages, please kindly consider making a donation. Any amount, no matter how small, goes a long way and is greatly appreciated. 🍺

[![Donate](https://mostafaznv.github.io/donate/donate.svg)](https://mostafaznv.github.io/donate)

----

## Demo

#### Video
https://github.com/mostafaznv/nova-laracache/assets/7619687/91bb08dd-0404-4b35-add4-4437486d2110

#### Screenshot
![1](https://github.com/mostafaznv/nova-laracache/assets/7619687/7daef1b7-0d00-4d6a-a8e3-592f68070248)

----


## License

This software is released under [The MIT License (MIT)](LICENSE.txt).
