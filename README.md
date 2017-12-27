# Brackets Checker

## Install
The preferred way to install this extension is through [composer](http://getcomposer.org/download/):
```
composer require maxvoronov/brackets-checker
```

## Usage
This package based on pure PHP. Library can check the correctness of the brackets sentence.
```php
use MaxVoronov\BracketsChecker;

$checker = new BracketsChecker("((()) ())");
$checker->isCorrect();  // Returns true
```

## Testing
```
composer test
```

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.