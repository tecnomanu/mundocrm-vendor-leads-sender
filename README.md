# Mundo CRM - Leads Sender

[![Latest Version](https://img.shields.io/github/release/tecnomanu/mundocrm-vendor-leads-sender)](https://github.com/tecnomanu/mundocrm-vendor-leads-sender/releases)
[![license: MIT](https://img.shields.io/badge/license-MIT-green.svg)](hhttps://github.com/tecnomanu/mundocrm-vendor-leads-sender/blob/main/LICENSE)

## Description

This package provide the methos to compile a form data and send to api.mundocrm.ar.

## What is included?
- Sender interface:
    - With this can generete you lead sender.
    - Send function to insert on your source the lead.
    - Validate and return response success or error.

## Installation and configuration

### Install via Composer

We recommend installing this package with [Composer](http://getcomposer.org/).

1. Download Composer

To download Composer, run in the root directory of your project:

```bash
curl -sS https://getcomposer.org/installer | php
```

You should now have the file `composer.phar` in your project directory.

2. Install Dependencies

Run in your project root:

```
php composer.phar require mundocrm/leads-sender
```

You should now have the files `composer.json` and `composer.lock` as well as
the directory `vendor` in your project directory. If you use a version control
system, `composer.json` should be added to it.

### Require Autoloader

After installing the dependencies, you need to require the Composer autoloader
from your code:

```php
require 'vendor/autoload.php';
```

## How can you use it

1. Create a new Sender:
```
 $leads = new Sender($app_key, $source_id, $data, $items, $debug); 
```

2. Instance ``send`` function:
```
$response = $leads->send();
```

3. Process the response as you preferer:
```
// Example to simple return
echo json_encode($response);

// Example to Laravel response:
return response()->json($response, $response->status_code);
```

### License
MuundoCRM and vendors are made available under the MIT License (MIT). Please see [ License File](https://github.com/tecnomanu/mundocrm-vendor-leads-sender/blob/main/LICENSEt) information.
