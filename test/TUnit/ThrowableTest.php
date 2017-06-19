<?php

namespace Dazzle\Throwable\Test\TUnit\Throwable;

use Dazzle\Throwable\Error;
use Dazzle\Throwable\Exception;
use Dazzle\Throwable\Throwable;
use Dazzle\Throwable\Test\TUnit;

class ThrowableTest extends TUnit
{
    /**
     *
     */
    public function testStaticApiParseThrowableMessage_ParsesThrowableMessage_ForError()
    {
        $prev = $this->createError('Previous');
        $ex   = $this->createError($message = 'Exception', 0, $prev);
        $stack = Throwable::getThrowableStack($ex);
        $base  = $this->callProtectedMethod(Throwable::class, 'getBasename', [ get_class($ex) ]);

        $this->assertRegExp("#\[$base\] \"$message\" in ThrowableTest:([0-9]*?)#si", Throwable::parseThrowableMessage($stack));
    }

    /**
     *
     */
    public function testStaticApiParseThrowableMessage_ParsesThrowableMessage_ForException()
    {
        $prev = $this->createException('Previous');
        $ex   = $this->createException($message = 'Exception', 0, $prev);
        $stack = Throwable::getThrowableStack($ex);
        $base  = $this->callProtectedMethod(Throwable::class, 'getBasename', [ get_class($ex) ]);

        $this->assertRegExp("#\[$base\] \"$message\" in ThrowableTest:([0-9]*?)#si", Throwable::parseThrowableMessage($stack));
    }

    /**
     *
     */
    public function testStaticApiGetThrowableStack_ReturnsStack_ForError()
    {
        $prev = $this->createError('Previous');
        $ex   = $this->createError($message = 'Exception', 0, $prev);

        $stack = Throwable::getThrowableStack($ex);
        $this->assertData($stack);
        $this->assertData($stack['prev']);
    }

    /**
     *
     */
    public function testStaticApiGetThrowableStack_ReturnsStack_ForException()
    {
        $prev = $this->createException('Previous');
        $ex   = $this->createException($message = 'Exception', 0, $prev);

        $stack = Throwable::getThrowableStack($ex);
        $this->assertData($stack);
        $this->assertData($stack['prev']);
    }

    /**
     *
     */
    public function testStaticApiGetThrowableData_ReturnsData_ForError()
    {
        $prev = $this->createError('Previous');
        $ex   = $this->createError($message = 'Exception', 0, $prev);

        $data = Throwable::getThrowableData($ex);
        $this->assertData($data);
    }

    /**
     *
     */
    public function testStaticApiGetThrowableData_ReturnsData_ForException()
    {
        $prev = $this->createException('Previous');
        $ex   = $this->createException($message = 'Exception', 0, $prev);

        $data = Throwable::getThrowableData($ex);
        $this->assertData($data);
    }

    /**
     *
     */
    public function testStaticApiGetTraceElements_ReturnsTraceElements_ForError()
    {
        $prev = $this->createError('Previous');
        $ex   = $this->createError('Exception', 0, $prev);

        $elements = $this->callProtectedMethod(Throwable::class, 'getTraceElements', [ $ex ]);
        $this->assertTrace($elements);
    }

    /**
     *
     */
    public function testStaticApiGetTraceElements_ReturnsTraceElements_ForException()
    {
        $prev = $this->createException('Previous');
        $ex   = $this->createException('Exception', 0, $prev);

        $elements = $this->callProtectedMethod(Throwable::class, 'getTraceElements', [ $ex ]);
        $this->assertTrace($elements);
    }

    /**
     *
     */
    public function testStaticApiParseTraceElement_ParsesSingleTraceElement()
    {
        $element = [
            'class'     => $class = 'someClass',
            'type'      => $type  = 'someType',
            'function'  => $func  = 'someFunction',
            'args'      => $args  = [ [], 'test' ],
            'file'      => $file  = 'someFile',
            'line'      => $line  = 50
        ];
        $parsed = $this->callProtectedMethod(Throwable::class, 'parseTraceElement', [ $element ]);
        $expected = "[call] $class$type$func(Array, \"test\") in $file:$line";

        $this->assertSame($expected, $parsed);
    }

    /**
     *
     */
    public function testStaticApiParseTraceElement_UsesPlaceholdersOnMissingParams()
    {
        $parsed = $this->callProtectedMethod(Throwable::class, 'parseTraceElement', [ [] ]);
        $expected = "[call] Undefined::undefined() in unknown:0";

        $this->assertSame($expected, $parsed);
    }

    /**
     *
     */
    public function testStaticApiParseArgs_ParsesEachArgumentToString()
    {
        $args = [
            $this->createException(''),
            [ 'A' ],
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum et metus vel.',
            'Test'
        ];
        $parsed = $this->callProtectedMethod(Throwable::class, 'parseArgs', [ $args ]);
        $expected = 'Dazzle\Throwable\Exception, Array, "Lorem ipsum dolor sit amet, cons...", "Test"';

        $this->assertSame($expected, $parsed);
    }

    /**
     *
     */
    public function testStaticApiGetBasename_ReturnsThrowableBasename_ForError()
    {
        $base = $this->callProtectedMethod(Throwable::class, 'getBasename', [ Error::class ]);
        $this->assertSame('Error', $base);
    }

    /**
     *
     */
    public function testStaticApiGetBasename_ReturnsThrowableBasename_ForException()
    {
        $base = $this->callProtectedMethod(Throwable::class, 'getBasename', [ Exception::class ]);
        $this->assertSame('Exception', $base);
    }

    /**
     * @param string $message
     * @param int $code
     * @param \Error|\Exception|null $prev
     * @return Exception
     */
    public function createException($message, $code = 0, $prev = null)
    {
        return new Exception($message, $code, $prev);
    }

    /**
     * @param string $message
     * @param int $code
     * @param \Error|\Exception|null $prev
     * @return Error
     */
    public function createError($message, $code = 0, $prev = null)
    {
        return new Error($message, $code, $prev);
    }

    /**
     * @param mixed[] $data
     */
    public function assertData($data)
    {
        $this->assertTrue(is_string($data['message']));
        $this->assertTrue($data['class'] === Error::class || $data['class'] === Exception::class );
        $this->assertRegExp('#^([a-zA-Z0-9\\\/\-_\.," ]*?)$#si', $data['file']);
        $this->assertRegExp('#^([0-9]*?)$#si', (string) $data['line']);
        $this->assertRegExp('#^([0-9]*?)$#si', (string) $data['code']);
        $this->assertTrace($data['trace']);
        $this->assertTrue(is_array($data['prev']) || $data['prev'] === null);
    }

    /**
     * @param string[] $elements
     */
    public function assertTrace($elements)
    {
        $throwRegex = '\[throwable\] ([a-zA-Z0-9\\\-_\. ]*?)\(\.\.\.\) in ([a-zA-Z0-9\\\-_\.," ]*?)(.+)([0-9]*?)';
        $callRegex  = '\[call\] ([a-zA-Z0-9\\\-_\. ]*?)(->|::)([a-zA-Z0-9\\\-_\. ]*?)\(([a-zA-Z0-9\\\-_\.," ]*?)\) in ([a-zA-Z0-9\\\-_\.," ]*?)(.+)([0-9]*?)';
        $mainRegex  = '\[main\]';
        $regex = '#^(' . implode('|', [ $throwRegex, $callRegex, $mainRegex ]) . ')$#si';

        foreach ($elements as $element)
        {
            $this->assertRegExp($regex, $element);
        }
    }
}
