<?php

namespace Dazzle\Throwable\Test\TUnit\Throwable;

use Dazzle\Throwable\Test\TUnit\_Mock\ThrowableMock;
use Dazzle\Throwable\ThrowableProxy;
use Dazzle\Throwable\Test\TUnit;
use Error;
use Exception;
use LogicException;

class ThrowableProxyTest extends TUnit
{
    /**
     *
     */
    public function testApiConstructor_CreatesInstance()
    {
        $proxy = $this->createThrowableProxy('');
        $this->assertInstanceOf(ThrowableProxy::class, $proxy);
    }

    /**
     *
     */
    public function testApiConstructor_CreatesInstance_WhenErrorPassed()
    {
        $ex = new Error($message = 'Error');
        $proxy = $this->createThrowableProxy($ex);

        $this->assertInstanceOf(Error::class, $proxy->toThrowable());
        $this->assertSame($message, $proxy->toThrowable()->getMessage());
    }

    /**
     *
     */
    public function testApiConstructor_CreatesInstance_WhenExceptionPassed()
    {
        $ex = new Exception($message = 'Exception');
        $proxy = $this->createThrowableProxy($ex);

        $this->assertInstanceOf(Exception::class, $proxy->toThrowable());
        $this->assertSame($message, $proxy->toThrowable()->getMessage());
    }

    /**
     *
     */
    public function testApiConstructor_CreatesInstance_WhenStringArrayPassed()
    {
        $proxy = $this->createThrowableProxy([ Error::class, $message = 'Error' ]);

        $this->assertInstanceOf(Error::class, $proxy->toThrowable());
        $this->assertSame($message, $proxy->toThrowable()->getMessage());
    }

    /**
     *
     */
    public function testApiConstructor_CreatesInstance_WhenMessagePassed()
    {
        $proxy = $this->createThrowableProxy($message = 'Error');

        $this->assertInstanceOf(Exception::class, $proxy->toThrowable());
        $this->assertSame($message, $proxy->toThrowable()->getMessage());
    }

    /**
     *
     */
    public function testApiConstructor_CreatesInstance_WithPreviousElementBeingError()
    {
        $prev = new Error('Previous');
        $ex = new Error('Error', 0, $prev);

        $proxy = $this->createThrowableProxy($ex);

        $throwable = $proxy->toThrowable();
        $this->assertInstanceOf(Error::class, $throwable);
        $this->assertSame('Error', $throwable->getMessage());

        $throwable = $throwable->getPrevious();
        $this->assertInstanceOf(Error::class, $throwable);
        $this->assertSame('Previous', $throwable->getMessage());
    }

    /**
     *
     */
    public function testApiConstructor_CreatesInstance_WithPreviousElementBeingFrameworkError()
    {
        $prev = new \Dazzle\Throwable\Error('Previous');
        $ex = new \Dazzle\Throwable\Error('Error', 0, $prev);

        $proxy = $this->createThrowableProxy($ex);

        $throwable = $proxy->toThrowable();
        $this->assertInstanceOf(\Dazzle\Throwable\Error::class, $throwable);
        $this->assertSame('Error', $throwable->getMessage());

        $throwable = $throwable->getPrevious();
        $this->assertInstanceOf(\Dazzle\Throwable\Error::class, $throwable);
        $this->assertSame('Previous', $throwable->getMessage());
    }

    /**
     *
     */
    public function testApiConstructor_CreatesInstance_WithPreviousElementBeingException()
    {
        $prev = new \Dazzle\Throwable\Exception('Previous');
        $ex = new \Dazzle\Throwable\Exception('Exception', 0, $prev);

        $proxy = $this->createThrowableProxy($ex);

        $throwable = $proxy->toThrowable();
        $this->assertInstanceOf(\Dazzle\Throwable\Exception::class, $throwable);
        $this->assertSame('Exception', $throwable->getMessage());

        $throwable = $throwable->getPrevious();
        $this->assertInstanceOf(\Dazzle\Throwable\Exception::class, $throwable);
        $this->assertSame('Previous', $throwable->getMessage());
    }

    /**
     *
     */
    public function testApiDestructor_DoesNotThrowException()
    {
        $proxy = $this->createThrowableProxy('');
        unset($proxy);
    }

    /**
     *
     */
    public function testApiSetContext_SetsContext()
    {
        $ex = $this->createThrowableProxy('');

        $ex->setContext($context = [ 5, 'ABC', new \StdClass ]);

        $this->assertSame($context, $this->getProtectedProperty($ex, 'context'));
    }

    /**
     *
     */
    public function testApiGetContext_GetsContext()
    {
        $ex = $this->createThrowableProxy('');

        $ex->setContext($context = [ 5, 'ABC', new \StdClass ]);

        $this->assertSame($context, $ex->getContext());
    }

    /**
     *
     */
    public function testApiToString_ReturnsString()
    {
        $prev = new Exception('Previous');
        $ex = new LogicException('Exception', 0, $prev);

        $proxy = $this->createThrowableProxy($ex);

        $this->assertString((string) $proxy);
    }

    /**
     *
     */
    public function testApiToThrowable_ReturnsOriginal()
    {
        $ex = new LogicException();
        $proxy = $this->createThrowableProxy($ex);

        $this->assertInstanceOf(LogicException::class, $proxy->toThrowable());
    }

    /**
     *
     */
    public function testApiGetMessage_ReturnsMessage()
    {
        $ex = new LogicException($message = 'Exception');
        $proxy = $this->createThrowableProxy($ex);

        $this->assertSame($message, $proxy->getMessage());
    }

    /**
     *
     */
    public function testApiGetCode_ReturnsCode()
    {
        $mock = new ThrowableMock;

        $proxy = $this->getMock(ThrowableProxy::class, [ 'toThrowable' ], [], '', false);
        $proxy
            ->expects($this->once())
            ->method('toThrowable')
            ->will($this->returnValue($mock));

        $this->assertSame($mock->getCode(), $proxy->getCode());
    }

    /**
     *
     */
    public function testApiGetFile_ReturnsFile()
    {
        $mock = new ThrowableMock;

        $proxy = $this->getMock(ThrowableProxy::class, [ 'toThrowable' ], [], '', false);
        $proxy
            ->expects($this->once())
            ->method('toThrowable')
            ->will($this->returnValue($mock));

        $this->assertSame($mock->getFile(), $proxy->getFile());
    }

    /**
     *
     */
    public function testApiGetLine_ReturnsLine()
    {
        $mock = new ThrowableMock;

        $proxy = $this->getMock(ThrowableProxy::class, [ 'toThrowable' ], [], '', false);
        $proxy
            ->expects($this->once())
            ->method('toThrowable')
            ->will($this->returnValue($mock));

        $this->assertSame($mock->getLine(), $proxy->getLine());
    }

    /**
     *
     */
    public function testApiGetTrace_ReturnsTrace()
    {
        $mock = new ThrowableMock;

        $proxy = $this->getMock(ThrowableProxy::class, [ 'toThrowable' ], [], '', false);
        $proxy
            ->expects($this->once())
            ->method('toThrowable')
            ->will($this->returnValue($mock));

        $this->assertSame($mock->getTrace(), $proxy->getTrace());
    }

    /**
     *
     */
    public function testApiGetPrevious_ReturnsNull_WhenPreviousDoesNotExist()
    {
        $ex = new Exception('Exception');

        $proxy = $this->createThrowableProxy($ex);

        $this->assertSame(null, $proxy->getPrevious());
    }

    /**
     *
     */
    public function testApiGetPrevious_ReturnsPrevious_WhenPreviousDoesExist()
    {
        $prev = new LogicException('Previous');
        $ex = new Exception('Exception', 0, $prev);

        $proxy = $this->createThrowableProxy($ex);

        $this->assertInstanceOf(LogicException::class, $proxy->getPrevious());
    }

    /**
     *
     */
    public function testApiGetTraceAsString_ReturnsTraceAsString()
    {
        $mock = new ThrowableMock;

        $proxy = $this->getMock(ThrowableProxy::class, [ 'toThrowable' ], [], '', false);
        $proxy
            ->expects($this->once())
            ->method('toThrowable')
            ->will($this->returnValue($mock));

        $this->assertSame($mock->getTraceAsString(), $proxy->getTraceAsString());
    }

    /**
     * @param \Error|\Exception|string[]|string $exceptionOrMessage
     * @param string[]|null $methods
     * @return ThrowableProxy|\PHPUnit_Framework_MockObject_MockObject
     */
    public function createThrowableProxy($exceptionOrMessage, $methods = null)
    {
        return $this->getMock(ThrowableProxy::class, $methods, [ $exceptionOrMessage ]);
    }

    /**
     * @param string $string
     */
    public function assertString($string)
    {
        $throwRegex = "\t" . '([0-9 ]*?)\. \[throwable\] ([a-zA-Z0-9\\\-_\. ]*?)\(\.\.\.\) in ([a-zA-Z0-9\\\-_\.," ]*?)(.+)([0-9]*?)';
        $callRegex  = "\t" . '([0-9 ]*?)\. \[call\] ([a-zA-Z0-9\\\-_\. ]*?)(->|::)([a-zA-Z0-9\\\-_\. ]*?)\(([a-zA-Z0-9\\\-_\.," ]*?)\) in ([a-zA-Z0-9\\\-_\.," ]*?)(.+)([0-9]*?)';
        $mainRegex  = "\t" . '([0-9 ]*?)\. \[main\]';
        $stackRegex = "\t" . '([0-9 ]*?)\. \[([a-zA-Z0-9\\\-_\. ]*?)\] "(.*?)"';
        $throwTitleRegex = "\t" . 'Throwable trace:';
        $stackTitleRegex = "\t" . 'Stack trace:';
        $regex = '(' . implode('|', [ $throwRegex, $callRegex, $mainRegex,  $stackRegex, $throwTitleRegex, $stackTitleRegex ]) . ')';

        $this->assertRegExp('#^' . $regex . '$#msi', $string);
    }
}
