# Leads Sender 1.0 #

## Description ##

This package provide the methos to compile a form data and send to api.leads.com.ar.

## Install via Composer ##

We recommend installing this package with [Composer](http://getcomposer.org/).

### Download Composer ###

To download Composer, run in the root directory of your project:

```bash
curl -sS https://getcomposer.org/installer | php
```

You should now have the file `composer.phar` in your project directory.

### Install Dependencies ###

Run in your project root:

```
php composer.phar require ideasconectadas/leads-sender
```

You should now have the files `composer.json` and `composer.lock` as well as
the directory `vendor` in your project directory. If you use a version control
system, `composer.json` should be added to it.

### Require Autoloader ###

After installing the dependencies, you need to require the Composer autoloader
from your code:

```php
require 'vendor/autoload.php';
```

## Install via Phar ##

Although we strongly recommend using Composer, we also provide a
[phar archive](http://php.net/manual/en/book.phar.php) containing most of the
dependencies for GeoIP2. Our latest phar archive is available on
[our releases page](https://github.com/maxmind/GeoIP2-php/releases).

### Install Dependencies ###

In order to use the phar archive, you must have the PHP
[Phar extension](http://php.net/manual/en/book.phar.php) installed and
enabled.

If you will be making web service requests, you must have the PHP
[cURL extension](http://php.net/manual/en/book.curl.php)
installed to use this archive. For Debian based distributions, this can
typically be found in the the `php-curl` package. For other operating
systems, please consult the relevant documentation. After installing the
extension you may need to restart your web server.