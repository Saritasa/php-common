# PHP Common classes

[![Build Status](https://travis-ci.org/Saritasa/php-common.svg?branch=master)](https://travis-ci.org/Saritasa/php-common)
[![CodeCov](https://codecov.io/gh/Saritasa/php-common/branch/master/graph/badge.svg)](https://codecov.io/gh/Saritasa/php-common)
[![Release](https://img.shields.io/github/release/saritasa/php-common.svg)](https://github.com/Saritasa/php-common/releases)
[![PHPv](https://img.shields.io/packagist/php-v/saritasa/php-common.svg)](http://www.php.net)
[![Downloads](https://img.shields.io/packagist/dt/saritasa/php-common.svg)](https://packagist.org/packages/saritasa/php-common)

Common Saritasa classes and helpers, that can be used universally in any application.
This package should not depend on any framework or library.

## Usage

Install the ```saritasa/php-common``` package:

```bash
$ composer require saritasa/php-common
```

## Available classes

### Enum
Alternative for [SplEnum](http://php.net/manual/ru/class.splenum.php) class.
Designed to be container for repeatedly used set of constants.

**Example**:
```php
class LogicOperations extends Saritasa\Enum
{
    protected const AND = null;
    protected const OR = null;
    protected const XOR = null;
}
```
then somewhere in code:
```php
$operations = LogicOperations::getConstantNames(); // returns ['AND', 'OR', 'XOR']
...
function getLogicOperationDependentValue(LogicOperations $op) 
{
    if ($op === LogicOperations::OR()) { ... }
    ...
    switch ($op) {
        case LogicOperations::AND():
            ....
            break;
        case LogicOperations::OR():
            ...
            break;
        case LogicOperations::XOR():
            ...
            break;
        default:
            ...
    }
}
...
$xor = LogicOperations::XOR();
echo getLogicOperationDependentValue($xor);
...
echo $xor;              // will display XOR
echo json_encode($xor); // will display "XOR"
...
$foo = LogicOperations::FOO(); // will throw InvalidEnumValueException on unknown value
...
if ($xor == 'XOR') {}   // the condition is TRUE because of Enum::toString()
```

The enum class body can include methods and other fields (Java style):
```php
class TeamGender extends Saritasa\Enum
{
    protected const MEN = ['Men', false];
    protected const WOMEN = ['Women', false];
    protected const MIXED = ['Co-ed', true];
    
    private $name = '';
    private $mixed = false;
    
    protected function __construct(string $name, bool $mixed)
    {
        $this->name = $name;
        $this->mixed = $mixed;
    }
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function getIsMixed(): bool
    {
        return $this->mixed;
    }
}
```
then somewhere in code:
```php
$genders = Gender::getConstants(); 
// returns ['MEN' => ['Men', false], 'WOMEN' => ['Women', false], 'MIXED' => ['Co-ed', true]]
...
echo TeamGender::MEN();                      // will display MEN
echo TeamGender::WOMEN('name');              // will display Women
echo TeamGender::WOMEN()->getName();         // will display Women
echo (int)TeamGender::MIXED('isMixed');      // will display 1
echo (int)TeamGender::MIXED()->getIsMixed(); // will display 1
```

**Note:** It's recommended to make enum constants protected or private (because each enum value 
is actually an object and public constants break the encapsulation). However, constant access
modifiers are only available since PHP 7.1

### Dto
A simple DTO, that can convert associative array to strong typed class with fields and back:

```php
/**
 * @property-read string $name Person full name
 * @property-read string $address Street address
 * @property-read string $city City
 * @property-read string $state State
 * @property-read string $zip Zip Code
 */
class Address extends Dto
{
    protected $name;
    protected $address;
    protected $city;
    protected $state;
    protected $zip;
}
...
$address = new Address($request->all()) // Read only Address fields from HTTP Request
$address->toArray() // Convert to assotiative array
$address->toJson()  // Serialize to JSON format

```

### RegExp
Reusable wrapper for preg_match;

**Example**:
```php
$isEmail = new RegExp('/\w+@\w+\.\w+/');
$result = $isEmail('test@it');
```

## Exception Definitions
### ConfigurationException
Throw this, if you find erroneous configuration.

**Example**:
```
$payPalKey = config('services.paypal_key');
if (!$payPalKey) {
    throw new ConfigurationException("PayPal key is not configured");
}

```

### PagingException
Throw this, if you implement paging and encounter an unrecoverable problem

### PaymentException
Throw this, if you implement payment service or wrapper around payment service 
and encounter an unrecoverable problem.

## Contributing

### Requirements
This package must:
* Do not depend on any framework or library
* Do not depend on other Saritasa packages
* Do not register any providers

1. Create fork, checkout it
2. Develop locally as usual. **Code must follow [PSR-1](http://www.php-fig.org/psr/psr-1/), [PSR-2](http://www.php-fig.org/psr/psr-2/)** -
    run [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) to ensure, that code follows style guides
3. **Cover added functionality with unit tests** and run [PHPUnit](https://phpunit.de/) to make sure, that all tests pass
4. Update [README.md](README.md) to describe new or changed functionality
5. Add changes description to [CHANGES.md](CHANGES.md) file. Use [Semantic Versioning](https://semver.org/) convention to determine next version number.
6. When ready, create pull request

### Make shortcuts

If you have [GNU Make](https://www.gnu.org/software/make/) installed, you can use following shortcuts:

* ```make cs``` (instead of ```php vendor/bin/phpcs```) -
    run static code analysis with [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
    to check code style
* ```make csfix``` (instead of ```php vendor/bin/phpcbf```) -
    fix code style violations with [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
    automatically, where possible (ex. PSR-2 code formatting violations)
* ```make test``` (instead of ```php vendor/bin/phpunit```) -
    run tests with [PHPUnit](https://phpunit.de/)
* ```make install``` - instead of ```composer install```
* ```make all``` or just ```make``` without parameters -
    invokes described above **install**, **cs**, **test** tasks sequentially -
    project will be assembled, checked with linter and tested with one single command

## Resources

* [Bug Tracker](http://github.com/saritasa/php-common/issues)
* [Code](http://github.com/saritasa/php-common)
* [Changes History](CHANGES.md)
* [Authors](http://github.com/saritasa/php-common/contributors)
