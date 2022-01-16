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
 * @covers \Tailors\Logic\FunctionalExpressionTrait
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class FunctionalExpressionTraitTest extends TestCase
{
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    /**
     * @psalm-param array<ExpressionInterface> $arguments
     */
    public function getFunctionalExpression(FunctionalInterface $functional, array $arguments): ExpressionInterface
    {
        return new /** @psalm-immutable */ class($functional, $arguments) implements ExpressionInterface {
            use FunctionalExpressionTrait;

            /**
             * @psalm-param array<ExpressionInterface> $arguments
             */
            public function __construct(FunctionalInterface $functional, array $arguments)
            {
                $this->functional = $functional;
                $this->arguments = $arguments;
            }
        };
    }

    /**
     * @psalm-return array<array-key, array{
     *      0: FunctionalInterface::NOTATION_*,
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
            [FunctionalInterface::NOTATION_PREFIX, 'f', [$a, $b], 'f(a, b)'],
            [FunctionalInterface::NOTATION_INFIX, '+', [$a, $b], '(a + b)'],
            [FunctionalInterface::NOTATION_SUFFIX, 'f', [$a, $b], '(a, b)f'],
            [FunctionalInterface::NOTATION_SYMBOL, 'f', [$a, $b], 'f'],
        ];
    }

    /**
     * @dataProvider providerExpressionString
     *
     * @psalm-param FunctionalInterface::NOTATION_* $notation
     * @psalm-param array<ExpressionInterface> $arguments
     */
    public function testExpressionString(int $notation, string $symbol, array $arguments, string $result): void
    {
        $functional = $this->getMockBuilder(FunctionalInterface::class)
            ->onlyMethods(['symbol', 'notation', 'arity'])
            ->getMock()
        ;

        $functional->expects($this->never())
            ->method('arity')
        ;

        $functional->expects($this->once())
            ->method('notation')
            ->willReturn($notation)
        ;

        $functional->expects($this->once())
            ->method('symbol')
            ->willReturn($symbol)
        ;

        $expression = $this->getFunctionalExpression($functional, $arguments);

        $this->assertSame($result, $expression->expressionString());
    }
}
