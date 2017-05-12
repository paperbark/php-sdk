# PaperBark
This repository contains the open source code for the PaperBark PHP Development Kit.
For more information on how to use PaperBark or the PaperBark API please look at our [Documentation](https://github.com/paperbark/documentation/blob/master/readme.md) repository.

## Installation
The recommended way of installing the SDK is using [Composer](https://getcomposer.org/). Run this command:
```sh
composer require paperbark/php-sdk
```

## Usage
```php
// Create a new PaperBark instance
$pb = new PaperBark\PaperBark('{token}');

// Convert HTML to PDF
echo $pb->convert('<strong>PaperBark PHP SDK</strong>');
```

## License
Please see the [license file](https://github.com/paperbark/php-sdk/blob/master/LICENSE.md) for more information.
