<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tailors\PHPUnit\ImplementsInterfaceTrait;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
#[CoversClass(AbstractFunction::class)]
final class AbstractFunctionTest extends TestCase
{
    use ImplementsInterfaceTrait;

    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    /**
     * @psalm-return \PHPUnit\Framework\MockObject\MockObject&AbstractFunction<0|positive-int,mixed,list<mixed>>
     */
    public function getAbstractFunctionMock()
    {
        $func = $this->getMockBuilder(AbstractFunction::class)
            ->onlyMethods([
                'applyImpl',
                'arity',
                'notation',
                'symbol',
                'validate',
                'precedence',
            ])->getMock()
        ;

        $func->expects($this->never())
            ->method('arity')
        ;

        $func->expects($this->never())
            ->method('notation')
        ;

        $func->expects($this->never())
            ->method('symbol')
        ;

        $func->expects($this->never())
            ->method('precedence')
        ;

        return $func;
    }

    public function testImplementsFunctionInterface(): void
    {
        $this->assertImplementsInterface(FunctionInterface::class, AbstractFunction::class);
    }

    public function testApplyCallsValidateAndApplyImpl(): void
    {
        $func = $this->getAbstractFunctionMock();

        $func->expects($this->once())
            ->method('applyImpl')
            ->with([0 => 'X', 1 => 'Y', 2 => 'Z'])
            ->willReturn('XYZ')
        ;

        $func->expects($this->once())
            ->method('validate')
            ->with([0 => 'X', 1 => 'Y', 2 => 'Z'])
        ;

        $arguments = [0 => 'X', 5 => 'Y', 8 => 'Z'];
        $this->assertSame('XYZ', $func->apply(...$arguments));
    }
}
