<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
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
 * @psalm-type FunctorTestParams = FunctorMockParams & array{
 *      arguments?: array<string>
 * }
 *
 * @internal
 */
#[CoversClass(AbstractFunctorExpression::class)]
final class AbstractFunctorExpressionTest extends TestCase
{
    use GetFunctorMockTrait;

    #[\Override]
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
    public static function providerExpressionString(): array
    {
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
                    'arguments' => ['a'],
                ],
            ],
            [
                '@ a b',
                [
                    'notation'  => FunctorInterface::NOTATION_PREFIX,
                    'symbol'    => '@',
                    'arguments' => ['a', 'b'],
                ],
            ],
            [
                '@ a b c',
                [
                    'notation'  => FunctorInterface::NOTATION_PREFIX,
                    'symbol'    => '@',
                    'arguments' => ['a', 'b', 'c'],
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
                    'arguments' => ['a'],
                ],
            ],
            [
                'a @ b',
                [
                    'notation'  => FunctorInterface::NOTATION_INFIX,
                    'symbol'    => '@',
                    'arguments' => ['a', 'b'],
                ],
            ],
            [
                'a @ b @ c',
                [
                    'notation'  => FunctorInterface::NOTATION_INFIX,
                    'symbol'    => '@',
                    'arguments' => ['a', 'b', 'c'],
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
                    'arguments' => ['a'],
                ],
            ],
            [
                'a b @',
                [
                    'notation'  => FunctorInterface::NOTATION_SUFFIX,
                    'symbol'    => '@',
                    'arguments' => ['a', 'b'],
                ],
            ],
            [
                'a b c @',
                [
                    'notation'  => FunctorInterface::NOTATION_SUFFIX,
                    'symbol'    => '@',
                    'arguments' => ['a', 'b', 'c'],
                ],
            ],
            [
                '@',
                [
                    'notation'  => FunctorInterface::NOTATION_SYMBOL,
                    'symbol'    => '@',
                    'arguments' => ['a', 'b'],
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
                    'arguments' => ['a'],
                ],
            ],
            [
                '@(a, b)',
                [
                    'notation'  => FunctorInterface::NOTATION_FUNCTION,
                    'symbol'    => '@',
                    'arguments' => ['a', 'b'],
                ],
            ],
            [
                '@ a b',
                [
                    'notation'   => FunctorInterface::NOTATION_PREFIX,
                    'symbol'     => '@',
                    'arguments'  => ['a', 'b'],
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
                    'arguments'  => ['a', 'b'],
                    'precedence' => 1,
                ],
                [
                    'notation'   => FunctorInterface::NOTATION_INFIX,
                    'arguments'  => ['a', 'b'],
                    'precedence' => 2,
                ],
            ],
            [
                'a',
                [
                    'notation'  => FunctorInterface::NOTATION_INFIX,
                    'symbol'    => '@',
                    'arguments' => ['a'],
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
                    'arguments'  => ['a', 'b'],
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
                    'arguments'  => ['a', 'b'],
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
                    'arguments'  => ['a', 'b'],
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
                    'arguments'  => ['a', 'b'],
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
                    'arguments'  => ['a', 'b'],
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
                    'arguments'  => ['a', 'b'],
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
                    'arguments'  => ['a', 'b'],
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
                    'arguments'  => ['a', 'b'],
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
                    'arguments'  => ['a', 'b'],
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
                    'arguments' => ['a', 'b'],
                ],
                [
                    'notation' => FunctorInterface::NOTATION_FUNCTION,
                ],
            ],
        ];
    }

    /**
     * @psalm-param FunctorTestParams $functorParams
     * @psalm-param FunctorTestParams $parentParams
     */
    #[DataProvider('providerExpressionString')]
    public function testExpressionString(string $result, array $functorParams, ?array $parentParams = null): void
    {
        $functor = $this->getFunctorMock($functorParams);

        $arguments = array_map(fn (string $symbol) => $this->getSymbolExpressionMock($symbol), $functorParams['arguments'] ?? []);

        $expression = new
            /**
             * @psalm-immutable
             *
             * @psalm-suppress MissingTemplateParam
             */
            class($functor, $arguments) extends AbstractFunctorExpression {};

        if (null !== $parentParams) {
            $parentExpression = $this->getParentFunctorExpressionMock($parentParams);

            /** @var FunctorExpressionInterface<ExpressionInterface> $parentExpression */
            $this->assertSame($result, $expression->expressionString($parentExpression));
        } else {
            $this->assertSame($result, $expression->expressionString());
        }
    }

    /**
     * @psalm-param FunctorTestParams $parentParams
     *
     * @psalm-return MockObject&FunctorExpressionInterface<ExpressionInterface>
     */
    protected function getParentFunctorExpressionMock(array $parentParams): MockObject
    {
        $parentExpression = $this->getMockBuilder(FunctorExpressionInterface::class)
            ->onlyMethods(['functor', 'arguments'])
            ->getMock()
        ;

        $parentExpression->expects($this->never())
            ->method('arguments')
        ;

        $parentFunctor = $this->getFunctorMock($parentParams);

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
