# PHP Common classes

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
class Gender extends Saritasa\Enum
{
    const MALE = 'Male';
    const FEMALE = 'Female';
}
```
then somewere in code:
```php
$allGenders = Gender::getConstants();
$gender = new Gender($stringValue); // Will throw UnexpectedValueException on unknown value;
function getGenderDependentValue(Gender $gender) { ... }
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

1. Create fork
2. Checkout fork
3. Develop locally as usual. **Code must follow [PSR-1](http://www.php-fig.org/psr/psr-1/), [PSR-2](http://www.php-fig.org/psr/psr-2/)**
4. Update [README.md](README.md) to describe new or changed functionality. Add changes description to [CHANGES.md](CHANGES.md) file.
5. When ready, create pull request

## Resources

* [Bug Tracker](http://github.com/saritasa/php-common/issues)
* [Code](http://github.com/saritasa/php-common)
* [Changes History](CHANGES.md)
* [Authors](http://github.com/saritasa/php-common/contributors)
