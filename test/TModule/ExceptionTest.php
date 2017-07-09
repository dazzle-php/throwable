<?php

namespace Dazzle\Throwable\Test\TModule\Throwable;

use Dazzle\Throwable\Exception\Logic\ResourceUndefinedException;
use Dazzle\Throwable\Exception\Logic\ResourceOccupiedException;
use Dazzle\Throwable\Exception\Logic\IllegalCallException;
use Dazzle\Throwable\Exception\Logic\IllegalFieldException;
use Dazzle\Throwable\Exception\Logic\InstantiationException;
use Dazzle\Throwable\Exception\Logic\InvalidArgumentException;
use Dazzle\Throwable\Exception\Logic\InvalidFormatException;
use Dazzle\Throwable\Exception\Logic\ResourceException;
use Dazzle\Throwable\Exception\Runtime\CancellationException;
use Dazzle\Throwable\Exception\Runtime\RejectionException;
use Dazzle\Throwable\Exception\Runtime\TimeoutException;
use Dazzle\Throwable\Exception\Runtime\ReadException;
use Dazzle\Throwable\Exception\Runtime\WriteException;
use Dazzle\Throwable\Exception\Runtime\ExecutionException;
use Dazzle\Throwable\Exception\Runtime\OutOfBoundsException;
use Dazzle\Throwable\Exception\Runtime\OverflowException;
use Dazzle\Throwable\Exception\Runtime\UnderflowException;
use Dazzle\Throwable\Exception\Runtime\UnexpectedValueException;
use Dazzle\Throwable\Exception\System\ChildUnresponsiveException;
use Dazzle\Throwable\Exception\System\ParentUnresponsiveException;
use Dazzle\Throwable\Exception\System\TaskIncompleteException;
use Dazzle\Throwable\Exception\LogicException;
use Dazzle\Throwable\Exception\RuntimeException;
use Dazzle\Throwable\Exception\SystemException;
use Dazzle\Throwable\Exception;
use Dazzle\Throwable\Test\TModule;

class ExceptionTest extends TModule
{
    /**
     *
     */
    public function testCaseExceptionStructure_IsValid()
    {
        $structure = [
            ResourceUndefinedException::class   => LogicException::class,
            ResourceOccupiedException::class    => LogicException::class,
            IllegalCallException::class         => LogicException::class,
            IllegalFieldException::class        => LogicException::class,
            InstantiationException::class       => LogicException::class,
            InvalidArgumentException::class     => LogicException::class,
            InvalidFormatException::class       => LogicException::class,
            ResourceException::class            => LogicException::class,
            CancellationException::class        => RuntimeException::class,
            RejectionException::class           => RuntimeException::class,
            TimeoutException::class             => RuntimeException::class,
            ReadException::class                => RuntimeException::class,
            WriteException::class               => RuntimeException::class,
            ExecutionException::class           => RuntimeException::class,
            OutOfBoundsException::class         => RuntimeException::class,
            OverflowException::class            => RuntimeException::class,
            UnderflowException::class           => RuntimeException::class,
            UnexpectedValueException::class     => RuntimeException::class,
            ChildUnresponsiveException::class   => SystemException::class,
            ParentUnresponsiveException::class  => SystemException::class,
            TaskIncompleteException::class      => SystemException::class,
            LogicException::class               => Exception::class,
            RuntimeException::class             => Exception::class,
            SystemException::class              => Exception::class
        ];

        foreach ($structure as $class=>$extended)
        {
            $this->assertInstanceOf($extended, new $class);
        }
    }
}
