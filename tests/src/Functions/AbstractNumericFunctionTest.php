<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

use PHPUnit\Framework\TestCase;
use Tailors\Logic\Validators\NumbersArglistValidatorInterface;
use Tailors\PHPUnit\ExtendsClassTrait;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @covers \Tailors\Logic\Functions\AbstractNumericFunction
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class AbstractNumericFunctionTest extends TestCase
{
    use ExtendsClassTrait;

    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testExtendsAbstractFunction(): void
    {
        $this->assertExtendsClass(AbstractFunction::class, AbstractNumericFunction::class);
    }

    /**
     * @uses \Tailors\Logic\Functions\AbstractFunction::apply
     */
    public function testApplyUsesProvidedValidator(): void
    {
        $validator = $this->getMockBuilder(NumbersArglistValidatorInterface::class)
            ->onlyMethods(['validate'])
            ->getMock()
        ;

        $function = $this->getMockBuilder(AbstractNumericFunction::class)
            ->setConstructorArgs([$validator])
            ->onlyMethods(['symbol', 'applyImpl', 'arity', 'notation', 'precedence'])
            ->getMock()
        ;

        $function->expects($this->once())
            ->method('symbol')
            ->willReturn('f')
        ;

        $function->expects($this->once())
            ->method('applyImpl')
            ->with(['x'])
            ->willReturn(123)
        ;

        $function->expects($this->never())
            ->method('arity')
        ;

        $function->expects($this->never())
            ->method('notation')
        ;

        $function->expects($this->never())
            ->method('precedence')
        ;

        $validator->expects($this->once())
            ->method('validate')
            ->with('f', ['x'])
        ;

        $this->assertSame(123, $function->apply('x'));
    }
}
