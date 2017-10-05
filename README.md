# sms-module

ZF3 module for SMS communication

[![Packagist](https://img.shields.io/packagist/v/massimo-filippi/sms-module.svg)](https://packagist.org/packages/massimo-filippi/sms-module)
[![License](http://img.shields.io/:license-mit-blue.svg)](http://doge.mit-license.org)

## Introduction

There will be more info soon...

## Installation

### 1. Install via Composer

Install the latest stable version via Composer:

```
composer require massimo-filippi/sms-module
```

Install the latest develop version via Composer:

```
composer require massimo-filippi/sms-module:dev-master
```

### 2. Enable module in your application

Composer should enable `MassimoFilippi\SmsModule` in your project automatically during installation. 

In case it does not, you can enable module manually by adding value `'MassimoFilippi\SmsModule'` to array in file `config/modules.config.php`. At the end, it should look like PHP array below.

```php
<?php

/**
 * List of enabled modules for this application.
 *
 * This should be an array of module namespaces used in the application.
 */
return [
    'Zend\Router',
    'Zend\Validator',
    'MassimoFilippi\SmsModule', // Add this line, ideally before Application module.
    'Application',
];
```

### 3. Set up your configuration

You have to set settings for SmsService, otherwise you will not be able to use it. 

Here is what I have in my `config/autoload/local.php` file.

*Warning:* DO NOT set passwords in files that are versioned!

```php
<?php
/**
 * Local Configuration Override
 *
 * This configuration override file is for overriding environment-specific and
 * security-sensitive configuration information. Copy this file without the
 * .dist extension at the end and populate values as needed.
 *
 * @NOTE: This file is ignored from Git by default with the .gitignore included
 * in ZendSkeletonApplication. This is a good practice, as it prevents sensitive
 * credentials from accidentally being committed into version control.
 */

use MassimoFilippi\SmsModule\ServiceProvider\SMSApiProvider;

return [
    'massimo_filippi' => [
        'sms_module' => [
            'type' => SMSApiProvider::class, // Type of the provider we want to use.
            'params' => [ // Some params needed to create chosen provider.
                'api_username' => 'john.doe',
                'api_password_hash' => '1234567890', // MD5 hash of password in case of SMSApi
            ],
        ],
    ],
];
```

## Usage

Somewhere in business logic classes.

```php
<?php 

use MassimoFilippi\SmsModule\Message\SmsMessage;

$smsMessage = new SmsMessage();

$smsMessage->setTo('00420123456789');
$smsMessage->setText('Hello World!');

try {
    // Injected MassimoFilippi\SmsModule\Service\SmsService.
    $this->smsService->sendSMS($smsMessage);
} catch (\Exception $exception) {
    var_dump($exception->getMessage());
}
```
