# Dazzle Throwable Hierarchy

[![Build Status](https://travis-ci.org/dazzle-php/throwable.svg)](https://travis-ci.org/dazzle-php/throwable)
[![Code Coverage](https://scrutinizer-ci.com/g/dazzle-php/throwable/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/dazzle-php/throwable/?branch=master)
[![Code Quality](https://scrutinizer-ci.com/g/dazzle-php/throwable/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/dazzle-php/throwable/?branch=master)
[![Latest Stable Version](https://poser.pugx.org/dazzle-php/throwable/v/stable)](https://packagist.org/packages/dazzle-php/throwable) 
[![Latest Unstable Version](https://poser.pugx.org/dazzle-php/throwable/v/unstable)](https://packagist.org/packages/dazzle-php/throwable) 
[![License](https://poser.pugx.org/dazzle-php/throwable/license)](https://packagist.org/packages/dazzle-php/throwable/license)

> **Note:** This repository is part of [Dazzle Project](https://github.com/dazzle-php/dazzle) - the next-gen library for PHP. The project's purpose is to provide PHP developers with a set of complete tools to build functional async applications. Please, make sure you read the attached README carefully and it is guaranteed you will be surprised how easy to use and powerful it is. In the meantime, you might want to check out the rest of our async libraries in [Dazzle repository](https://github.com/dazzle-php) for the full extent of Dazzle experience.

<br>
<p align="center">
<img src="https://raw.githubusercontent.com/dazzle-php/dazzle/master/media/dazzle-x125.png" />
</p>

## Description

Dazzle Throwable is a component that provides unified throwable hierarchy and additional helpers.

## Feature Highlights

Dazzle Throwable features:

* Custom hierarchy of Throwables created in mind of unifying error and exception handling in PHP5 and PHP7,
* Custom human-readable format for stack trace and exception trace,
* Support for chaining Throwables,
* Built-in ErrorHandler,
* Built-in ExceptionHandler,
* Implementation of throwable objects proxy,
* ...and more.

## Provided Example(s)

Provided throwable hierarchy:

```
Throwable
    Error
        FatalError
        WarningError
        NoticeError
    Exception
        LogicException
            IllegalCallException
            IllegalFieldException
            InstantiationException
            InvalidArgumentException
            InvalidFormatException
            ResourceException
            ResourceOccupiedException
            ResourceUndefinedException
        RuntimeException
            CancellationException
            ExecutionException
            OutOfBoundsException
            OverflowException
            ReadException
            RejectionException
            TimeoutException
            UndeflowException
            UnexpectedValueException
            WriteException
```

## Requirements

Dazzle Throwable requires:

* PHP-5.6 or PHP-7.0+,
* UNIX or Windows OS.

## Installation

To install this library make sure you have [composer](https://getcomposer.org/) installed, then run following command:

```
$> composer require dazzle-php/throwable
```

## Tests

Tests can be run via:

```
$> vendor/bin/phpunit -d memory_limit=1024M
```

## Versioning

Versioning of Dazzle libraries is described in versioning section of [Dazzle Project](https://github.com/dazzle-php/dazzle) index repository. Please, refer there for detailed information on the subject.

## Contributing

Thank you for considering contributing to this repository! 

- The contribution guide can be found in the [contribution tips](https://github.com/dazzle-php/throwable/blob/master/CONTRIBUTING.md). 
- Open tickets can be found in [issues section](https://github.com/dazzle-php/throwable/issues). 
- Current contributors are listed in [graphs section](https://github.com/dazzle-php/throwable/graphs/contributors)
- To contact the author(s) see the information attached in [composer.json](https://github.com/dazzle-php/throwable/blob/master/composer.json) file.

## License

Dazzle Throwable is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

<hr>
<p align="center">
<i>"Everything is possible. The impossible just takes longer."</i> ― Dan Brown
</p>
