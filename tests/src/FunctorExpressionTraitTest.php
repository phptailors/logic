<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic;

use PHPUnit\Framework\TestCase;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \Tailors\Logic\FunctorExpressionTrait
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class FunctorExpressionTraitTest extends TestCase
{
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    /**
     * @psalm-param array<ExpressionInterface> $arguments
     */
    public function getFunctorExpression(FunctorInterface $functor, array $arguments): ExpressionInterface
    {
        return new /** @psalm-immutable */ class($functor, $arguments) implements ExpressionInterface, FunctorExpressionInterface {
            use FunctorExpressionTrait;

            /**
             * @psalm-param array<ExpressionInterface> $arguments
             */
            public function __construct(FunctorInterface $functor, array $arguments)
            {
                $this->functor = $functor;
                $this->arguments = $arguments;
            }
        };
    }

    /**
     * @psalm-return array<array-key, array{
     *      0: FunctorInterface::NOTATION_*,
     *      1: string,
     *      2: array<ExpressionInterface>,
     *      3: string
     *  }>
     */
    public function providerExpressionString(): array
    {
        $a = $this->getMockBuilder(ExpressionInterface::class)
            ->onlyMethods(['expressionString'])
            ->getMock()
        ;
        $b = $this->getMockBuilder(ExpressionInterface::class)
            ->onlyMethods(['expressionString'])
            ->getMock()
        ;

        $a->expects($this->any())
            ->method('expressionString')
            ->willReturn('a')
        ;

        $b->expects($this->any())
            ->method('expressionString')
            ->willReturn('b')
        ;

        return [
            [FunctorInterface::NOTATION_PREFIX, 'f', [$a, $b], 'f(a, b)'],
            [FunctorInterface::NOTATION_INFIX, '+', [$a, $b], '(a + b)'],
            [FunctorInterface::NOTATION_SUFFIX, 'f', [$a, $b], '(a, b)f'],
            [FunctorInterface::NOTATION_SYMBOL, 'f', [$a, $b], 'f'],
        ];
    }

    /**
     * @dataProvider providerExpressionString
     *
     * @psalm-param FunctorInterface::NOTATION_* $notation
     * @psalm-param array<ExpressionInterface> $arguments
     */
    public function testExpressionString(int $notation, string $symbol, array $arguments, string $result): void
    {
        $functor = $this->getMockBuilder(FunctorInterface::class)
            ->onlyMethods(['symbol', 'notation', 'arity', 'precedence'])
            ->getMock()
        ;

        $functor->expects($this->never())
            ->method('arity')
        ;

        $functor->expects($this->never())
            ->method('precedence')
        ;

        $functor->expects($this->once())
            ->method('notation')
            ->willReturn($notation)
        ;

        $functor->expects($this->once())
            ->method('symbol')
            ->willReturn($symbol)
        ;

        $expression = $this->getFunctorExpression($functor, $arguments);

        $this->assertSame($result, $expression->expressionString());
    }
}
