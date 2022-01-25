<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \Tailors\Logic\AbstractFunctorExpression
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @psalm-import-type Arity from FunctorInterface
 * @psalm-import-type Precedence from FunctorInterface
 *
 * @psalm-type FunctorMockParams = array{
 *      symbol?: string,
 *      arity?: Arity,
 *      notation?: FunctorInterface::NOTATION_*,
 *      precedence?: Precedence,
 *  }
 *
 * @psalm-type FunctorTestParams = FunctorMockParams & array{
 *      arguments?: array<ExpressionInterface>
 * }
 *
 * @internal
 */
final class AbstractFunctorExpressionTest extends TestCase
{
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    /**
     * @psalm-return array<array-key, array{
     *      0: string,
     *      1: FunctorTestParams,
     *      2?: FunctorTestParams
     *  }>
     */
    public function providerExpressionString(): array
    {
        $a = $this->getSymbolExpressionMock('a');
        $b = $this->getSymbolExpressionMock('b');
        $c = $this->getSymbolExpressionMock('c');

        return [
            [
                '@',
                [
                    'notation'  => FunctorInterface::NOTATION_PREFIX,
                    'symbol'    => '@',
                    'arguments' => [],
                ],
            ],
            [
                '@ a',
                [
                    'notation'  => FunctorInterface::NOTATION_PREFIX,
                    'symbol'    => '@',
                    'arguments' => [$a],
                ],
            ],
            [
                '@ a b',
                [
                    'notation'  => FunctorInterface::NOTATION_PREFIX,
                    'symbol'    => '@',
                    'arguments' => [$a, $b],
                ],
            ],
            [
                '@ a b c',
                [
                    'notation'  => FunctorInterface::NOTATION_PREFIX,
                    'symbol'    => '@',
                    'arguments' => [$a, $b, $c],
                ],
            ],
            [
                '@',
                [
                    'notation'  => FunctorInterface::NOTATION_INFIX,
                    'symbol'    => '@',
                    'arguments' => [],
                ],
            ],
            [
                'a',
                [
                    'notation'  => FunctorInterface::NOTATION_INFIX,
                    'symbol'    => '@',
                    'arguments' => [$a],
                ],
            ],
            [
                'a @ b',
                [
                    'notation'  => FunctorInterface::NOTATION_INFIX,
                    'symbol'    => '@',
                    'arguments' => [$a, $b],
                ],
            ],
            [
                'a @ b @ c',
                [
                    'notation'  => FunctorInterface::NOTATION_INFIX,
                    'symbol'    => '@',
                    'arguments' => [$a, $b, $c],
                ],
            ],
            [
                '@',
                [
                    'notation'  => FunctorInterface::NOTATION_SUFFIX,
                    'symbol'    => '@',
                    'arguments' => [],
                ],
            ],
            [
                'a @',
                [
                    'notation'  => FunctorInterface::NOTATION_SUFFIX,
                    'symbol'    => '@',
                    'arguments' => [$a],
                ],
            ],
            [
                'a b @',
                [
                    'notation'  => FunctorInterface::NOTATION_SUFFIX,
                    'symbol'    => '@',
                    'arguments' => [$a, $b],
                ],
            ],
            [
                'a b c @',
                [
                    'notation'  => FunctorInterface::NOTATION_SUFFIX,
                    'symbol'    => '@',
                    'arguments' => [$a, $b, $c],
                ],
            ],
            [
                '@',
                [
                    'notation'  => FunctorInterface::NOTATION_SYMBOL,
                    'symbol'    => '@',
                    'arguments' => [$a, $b],
                ],
            ],
            [
                '@()',
                [
                    'notation'  => FunctorInterface::NOTATION_FUNCTION,
                    'symbol'    => '@',
                    'arguments' => [],
                ],
            ],
            [
                '@(a)',
                [
                    'notation'  => FunctorInterface::NOTATION_FUNCTION,
                    'symbol'    => '@',
                    'arguments' => [$a],
                ],
            ],
            [
                '@(a, b)',
                [
                    'notation'  => FunctorInterface::NOTATION_FUNCTION,
                    'symbol'    => '@',
                    'arguments' => [$a, $b],
                ],
            ],
            [
                '@ a b',
                [
                    'notation'   => FunctorInterface::NOTATION_PREFIX,
                    'symbol'     => '@',
                    'arguments'  => [$a, $b],
                    'precedence' => 1,
                ],
                [
                    'notation'   => FunctorInterface::NOTATION_INFIX,
                    'precedence' => 2,
                ],
            ],
            [
                '@ a b',
                [
                    'notation'   => FunctorInterface::NOTATION_PREFIX,
                    'symbol'     => '@',
                    'arguments'  => [$a, $b],
                    'precedence' => 1,
                ],
                [
                    'notation'   => FunctorInterface::NOTATION_INFIX,
                    'arguments'  => [$a, $b],
                    'precedence' => 2,
                ],
            ],
            [
                'a',
                [
                    'notation'  => FunctorInterface::NOTATION_INFIX,
                    'symbol'    => '@',
                    'arguments' => [$a],
                ],
                [
                    'notation' => FunctorInterface::NOTATION_INFIX,
                ],
            ],
            [
                '@ a b',
                [
                    'notation'   => FunctorInterface::NOTATION_PREFIX,
                    'symbol'     => '@',
                    'arguments'  => [$a, $b],
                    'precedence' => 2,
                ],
                [
                    'notation'   => FunctorInterface::NOTATION_INFIX,
                    'precedence' => 2,
                ],
            ],
            [
                '@ a b',
                [
                    'notation'   => FunctorInterface::NOTATION_PREFIX,
                    'symbol'     => '@',
                    'arguments'  => [$a, $b],
                    'precedence' => 1,
                ],
                [
                    'notation'   => FunctorInterface::NOTATION_INFIX,
                    'precedence' => 2,
                ],
            ],
            [
                '(@ a b)',
                [
                    'notation'   => FunctorInterface::NOTATION_PREFIX,
                    'symbol'     => '@',
                    'arguments'  => [$a, $b],
                    'precedence' => 2,
                ],
                [
                    'notation'   => FunctorInterface::NOTATION_INFIX,
                    'precedence' => 1,
                ],
            ],
            [
                'a b @',
                [
                    'notation'   => FunctorInterface::NOTATION_SUFFIX,
                    'symbol'     => '@',
                    'arguments'  => [$a, $b],
                    'precedence' => 2,
                ],
                [
                    'notation'   => FunctorInterface::NOTATION_INFIX,
                    'precedence' => 2,
                ],
            ],
            [
                'a b @',
                [
                    'notation'   => FunctorInterface::NOTATION_SUFFIX,
                    'symbol'     => '@',
                    'arguments'  => [$a, $b],
                    'precedence' => 1,
                ],
                [
                    'notation'   => FunctorInterface::NOTATION_INFIX,
                    'precedence' => 2,
                ],
            ],
            [
                '(a b @)',
                [
                    'notation'   => FunctorInterface::NOTATION_SUFFIX,
                    'symbol'     => '@',
                    'arguments'  => [$a, $b],
                    'precedence' => 2,
                ],
                [
                    'notation'   => FunctorInterface::NOTATION_INFIX,
                    'precedence' => 1,
                ],
            ],
            [
                'a @ b',
                [
                    'notation'   => FunctorInterface::NOTATION_INFIX,
                    'symbol'     => '@',
                    'arguments'  => [$a, $b],
                    'precedence' => 2,
                ],
                [
                    'notation'   => FunctorInterface::NOTATION_INFIX,
                    'precedence' => 2,
                ],
            ],
            [
                'a @ b',
                [
                    'notation'   => FunctorInterface::NOTATION_INFIX,
                    'symbol'     => '@',
                    'arguments'  => [$a, $b],
                    'precedence' => 1,
                ],
                [
                    'notation'   => FunctorInterface::NOTATION_INFIX,
                    'precedence' => 2,
                ],
            ],
            [
                '(a @ b)',
                [
                    'notation'   => FunctorInterface::NOTATION_INFIX,
                    'symbol'     => '@',
                    'arguments'  => [$a, $b],
                    'precedence' => 2,
                ],
                [
                    'notation'   => FunctorInterface::NOTATION_INFIX,
                    'precedence' => 1,
                ],
            ],
            [
                'a @ b',
                [
                    'notation'  => FunctorInterface::NOTATION_INFIX,
                    'symbol'    => '@',
                    'arguments' => [$a, $b],
                ],
                [
                    'notation' => FunctorInterface::NOTATION_FUNCTION,
                ],
            ],
        ];
    }

    /**
     * @dataProvider providerExpressionString
     *
     * @psalm-param FunctorTestParams $functorParams
     * @psalm-param FunctorTestParams $parentParams
     */
    public function testExpressionString(string $result, array $functorParams, array $parentParams = null): void
    {
        $functor = (new FunctorMockConstructor($this))->getMock($functorParams);

        /** @var MockObject&AbstractFunctorExpression */
        $expression = $this->getMockBuilder(AbstractFunctorExpression::class)
            ->setConstructorArgs([$functor, $functorParams['arguments'] ?? []])
            ->getMockForAbstractClass()
        ;

        if (null !== $parentParams) {
            $parentExpression = $this->getParentFunctorExpressionMock($parentParams, $functorParams);
            /** @var FunctorExpressionInterface<ExpressionInterface> $parentExpression */
            $this->assertSame($result, $expression->expressionString($parentExpression));
        } else {
            $this->assertSame($result, $expression->expressionString());
        }
    }

    /**
     * @psalm-param FunctorTestParams $parentParams
     * @psalm-param FunctorTestParams $functorParams
     * @psalm-return MockObject&FunctorExpressionInterface<ExpressionInterface>
     */
    protected function getParentFunctorExpressionMock(array $parentParams, array $functorParams): MockObject
    {
        $parentExpression = $this->getMockBuilder(FunctorExpressionInterface::class)
            ->onlyMethods(['functor', 'arguments'])
            ->getMock()
        ;

        $parentExpression->expects($this->never())
            ->method('arguments')
        ;

        $parentFunctor = (new FunctorMockConstructor($this))->getMock($parentParams);

        $parentExpression->expects($this->once())
            ->method('functor')
            ->willReturn($parentFunctor)
        ;

        return $parentExpression;
    }

    /**
     * @psalm-return MockObject&ExpressionInterface
     */
    private function getSymbolExpressionMock(string $symbol): MockObject
    {
        $expr = $this->getMockBuilder(ExpressionInterface::class)
            ->onlyMethods(['expressionString'])
            ->getMock()
        ;

        $expr->expects($this->any())
            ->method('expressionString')
            ->willReturn($symbol)
        ;

        return $expr;
    }
}
