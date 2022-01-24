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
 * @covers \Tailors\Logic\AbstractFunctorExpression
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 *
 * @psalm-import-type Precedence from FunctorInterface
 *
 * @psalm-type FunctorParams = array{
 *      symbol?: string,
 *      notation?: FunctorInterface::NOTATION_*,
 *      arity?: 0|positive-int,
 *      precedence?: Precedence,
 *      arguments?: array<ExpressionInterface>,
 *  }
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
     *      1: FunctorParams,
     *      2?: FunctorParams
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
            [
                '@ a b',
                [
                    'notation'  => FunctorInterface::NOTATION_PREFIX,
                    'symbol'    => '@',
                    'arguments' => [$a, $b],
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
                'a b @',
                [
                    'notation'  => FunctorInterface::NOTATION_SUFFIX,
                    'symbol'    => '@',
                    'arguments' => [$a, $b],
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
                '@ a b',
                [
                    'notation'   => FunctorInterface::NOTATION_PREFIX,
                    'symbol'     => '@',
                    'arguments'  => [$a, $b],
                    'precedence' => 1,
                ],
                [
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
                    'precedence' => 1,
                ],
            ],
        ];
    }

    /**
     * @dataProvider providerExpressionString
     *
     * @psalm-param FunctorParams $functorParams
     * @psalm-param FunctorParams $parentParams
     */
    public function testExpressionString(string $result, array $functorParams, array $parentParams = null): void
    {
        $functor = $this->getFunctorMock($functorParams);

        /** @var \PHPUnit\Framework\MockObject\MockObject&AbstractFunctorExpression */
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
     * @psalm-param FunctorParams $params
     * @psalm-return \PHPUnit\Framework\MockObject\MockObject&FunctorInterface
     */
    protected function getFunctorMock(array $params): \PHPUnit\Framework\MockObject\MockObject
    {
        $methods = ['symbol', 'notation', 'arity', 'precedence'];
        $functor = $this->getMockBuilder(FunctorInterface::class)
            ->onlyMethods($methods)
            ->getMock()
        ;

        foreach ($methods as $key) {
            if (isset($params[$key])) {
                $functor->expects($this->once())
                    ->method($key)
                    ->willReturn($params[$key])
                ;
            } else {
                $functor->expects($this->never())
                    ->method($key)
                ;
            }
        }

        return $functor;
    }

    /**
     * @psalm-param FunctorParams $parentParams
     * @psalm-param FunctorParams $functorParams
     * @psalm-return \PHPUnit\Framework\MockObject\MockObject&FunctorExpressionInterface<ExpressionInterface>
     */
    protected function getParentFunctorExpressionMock(
        array $parentParams,
        array $functorParams
    ): \PHPUnit\Framework\MockObject\MockObject {
        $parentExpression = $this->getMockBuilder(FunctorExpressionInterface::class)
            ->onlyMethods(['functor', 'arguments'])
            ->getMock()
        ;

        $parentExpression->expects($this->never())
            ->method('arguments')
        ;

        $notation = $functorParams['notation'] ?? null;
        $arguments = $functorParams['arguments'] ?? [];

        $robustNotation = (
            FunctorInterface::NOTATION_SYMBOL === $notation
        ) || (
            FunctorInterface::NOTATION_FUNCTION === $notation
        );

        if (!$robustNotation && count($arguments) > 1) {
            $parentFunctor = $this->getFunctorMock($parentParams);

            $parentExpression->expects($this->once())
                ->method('functor')
                ->willReturn($parentFunctor)
            ;
        } else {
            $parentExpression->expects($this->never())
                ->method('functor')
            ;
        }

        return $parentExpression;
    }
}
