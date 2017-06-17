<?php

namespace Dazzle\Throwable\Test\TModule;

use Dazzle\Throwable\Error\FatalError;
use Dazzle\Throwable\Error\NoticeError;
use Dazzle\Throwable\Error\WarningError;
use Dazzle\Throwable\Error;
use Dazzle\Throwable\Test\TModule;

class ErrorTest extends TModule
{
    /**
     *
     */
    public function testCaseErrorStructure_IsValid()
    {
        $structure = [
            Error::class            => \Error::class,
            FatalError::class       => Error::class,
            WarningError::class     => Error::class,
            NoticeError::class      => Error::class
        ];

        foreach ($structure as $class=>$extended)
        {
            $this->assertInstanceOf($extended, new $class);
        }
    }


}
