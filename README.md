# Dazzle Throwable Hierarchy

[![Build Status](https://travis-ci.org/dazzle-php/throwable.svg)](https://travis-ci.org/dazzle-php/throwable)
[![Total Downloads](https://poser.pugx.org/dazzle-php/throwable/downloads)](https://packagist.org/packages/dazzle-php/throwable) 
[![Latest Stable Version](https://poser.pugx.org/dazzle-php/throwable/v/stable)](https://packagist.org/packages/dazzle-php/throwable) 
[![Latest Unstable Version](https://poser.pugx.org/dazzle-php/throwable/v/unstable)](https://packagist.org/packages/dazzle-php/throwable) 
[![License](https://poser.pugx.org/dazzle-php/throwable/license)](https://packagist.org/packages/dazzle-php/throwable/license)

<br>
<p align="center">
<img src="https://avatars0.githubusercontent.com/u/29509136?v=3&s=150" />
</p>

## Description

Dazzle Throwable is a component that provides unified throwable hierarchy and additional helpers.

## Feature Highlights

Throwable features:

* Custom hierarchy of Throwables created in mind of unifying error and exception handling in PHP5 and PHP7,
* Custom human-readable format for stack trace and exception trace,
* Support for chaining Throwables,
* Built-in ErrorHandler,
* Built-in ExceptionHandler,
* Implementation of throwable objects proxy,
* ...and more.

## Requirements

* PHP-5.6 or PHP-7.0+,
* UNIX or Windows OS.

## Installation

```
$> composer require dazzle-php/throwable
```

## Tests

```
$> vendor/bin/phpunit -d memory_limit=1024M --coverage-text
```

## Contributing

Thank you for considering contributing to this repository! The contribution guide can be found in the [contribution tips][1].

## License

Kraken Framework is open-sourced software licensed under the [MIT license][2].

[1]: https://github.com/dazzle-php/throwable/blob/master/CONTRIBUTING.md
[2]: http://opensource.org/licenses/MIT
