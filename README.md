# Brackets Checker

[![Latest Version](https://img.shields.io/packagist/v/MaxVoronov/brackets-checker.svg?style=flat)](https://packagist.org/packages/maxvoronov/brackets-checker)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/MaxVoronov/brackets-checker/master.svg?style=flat)](https://travis-ci.org/MaxVoronov/brackets-checker)
[![Codacy grade](https://img.shields.io/codacy/grade/e0c7af3a234e4cc68d4cc87281150808.svg?style=flat)]()

## Install
The preferred way to install this extension is through [composer](http://getcomposer.org/download/):
```
composer require maxvoronov/brackets-checker
```

## Usage
This package based on pure PHP. Library can check the correctness of the brackets sentence.
```php
use MaxVoronov\BracketsChecker\Checker;

$bracketsChecker = new Checker();
$bracketsChecker->check("(( ))( )");    // Returns true
$bracketsChecker->check("() )");        // Returns false
```

Also you can check custom brackets pairs and available filtering symbols:
```php
$brackets = ["(" => ")", "[" => "]", "<" => ">"];
$availableChars = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "+", "-", "*", "/", " "];

$bracketsChecker = new Checker($brackets, $availableChars);
$bracketsChecker->check("([2 + 3] * <10> / (9 - 4)))");    // Returns true
```

## Testing
```
composer test
```

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.