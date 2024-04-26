<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tailors\Logic\FunctorInterface;
use Tailors\Logic\FunctorMockConstructor;
use Tailors\Logic\TermInterface;
use Tailors\PHPUnit\ImplementsInterfaceTrait;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @covers \Tailors\Logic\Functions\FunctionTerm
 *
 * @uses \Tailors\Logic\AbstractFunctorExpression
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @psalm-import-type FunctorMockParams from FunctorMockConstructor
 *
 * @internal
 */
final class FunctionTermTest extends TestCase
{
    use ImplementsInterfaceTrait;

    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testImplementsTermInterface(): void
    {
        $this->assertImplementsInterface(TermInterface::class, FunctionTerm::class);
    }

    public function testFunctionReturnsProvidedFunction(): void
    {
        $f = $this->getMockBuilder(FunctionInterface::class)->getMock();

        /** @var FunctionInterface $f */
        $term = new FunctionTerm($f);
        $this->assertSame($f, $term->function());
    }

    public function testFunctorReturnsProvidedFunction(): void
    {
        $f = $this->getMockBuilder(FunctionInterface::class)->getMock();

        /** @var FunctionInterface $f */
        $term = new FunctionTerm($f);
        $this->assertSame($f, $term->functor());
    }

    public function testArgumentsReturnsProvidedArguments(): void
    {
        $f = $this->getMockBuilder(FunctionInterface::class)->getMock();
        $t1 = $this->getMockBuilder(TermInterface::class)->getMock();
        $t2 = $this->getMockBuilder(TermInterface::class)->getMock();

        /** @var FunctionInterface $f */
        $term = new FunctionTerm($f, $t1, $t2);
        $this->assertSame([$t1, $t2], $term->arguments());
    }

    /**
     * @psalm-return array<array-key, array{
     *  0: string,
     *  1: FunctorMockParams,
     *  2: list<string>,
     * }>
     */
    public function providerExpressionStringReturnsString(): array
    {
        return [
            [
                '@()',
                ['symbol' => '@', 'notation' => FunctorInterface::NOTATION_FUNCTION],
                [],
            ],
            [
                '@(t1)',
                ['symbol' => '@', 'notation' => FunctorInterface::NOTATION_FUNCTION],
                ['t1'],
            ],
            [
                '@(t1, t2)',
                ['symbol' => '@', 'notation' => FunctorInterface::NOTATION_FUNCTION],
                ['t1', 't2'],
            ],
        ];
    }

    /**
     * @dataProvider providerExpressionStringReturnsString
     *
     * @psalm-param FunctorMockParams $functorParams
     * @psalm-param array<string> $arguments
     */
    public function testExpressionStringReturnsString(string $result, array $functorParams, array $arguments): void
    {
        $arguments = array_map(function (string $symbol) {
            $term = $this->getMockBuilder(TermInterface::class)
                ->onlyMethods(['expressionString'])
                ->getMockForAbstractClass()
            ;
            $term->expects($this->once())
                ->method('expressionString')
                ->willReturn($symbol)
            ;

            return $term;
        }, $arguments);

        $mockCtor = new FunctorMockConstructor($this, FunctionInterface::class, ['apply' => true]);
        $function = $mockCtor->getMock($functorParams);

        /**
         * @var FunctionInterface    $function
         * @var array<TermInterface> $arguments
         */
        $term = new FunctionTerm($function, ...$arguments);
        $this->assertSame($result, $term->expressionString());
    }

    /**
     * @psalm-return array<array-key, array{
     *  0: mixed,
     *  1: FunctorMockParams,
     *  2: list,
     *  3: array<string,mixed>
     * }>
     */
    public function providerEvaluateReturnsValue(): array
    {
        return [
            [
                'ok',
                [],
                [],
                [],
            ],
            [
                'ok',
                [],
                ['x', 'y', 'z'],
                ['x' => 123],
            ],
        ];
    }

    /**
     * @dataProvider providerEvaluateReturnsValue
     *
     * @param mixed $result
     *
     * @psalm-param FunctorMockParams $functorParams
     * @psalm-param list $arguments
     * @psalm-param array<string, mixed> $environment
     */
    public function testEvaluateReturnsValue(
        $result,
        array $functorParams,
        array $arguments,
        array $environment
    ): void {
        $terms = array_map(
            /**
             * @param mixed $argument
             *
             * @psalm-return MockObject&TermInterface
             */
            function ($argument) use ($environment): MockObject {
                /** @psalm-var  MockObject&TermInterface */
                $term = $this->getMockBuilder(TermInterface::class)
                    ->onlyMethods(['evaluate'])
                    ->getMockForAbstractClass()
                ;
                $term->expects($this->once())
                    ->method('evaluate')
                    ->with($environment)
                    ->willReturn($argument)
                ;

                return $term;
            },
            $arguments
        );

        $mockCtor = new FunctorMockConstructor($this, FunctionInterface::class, ['apply' => false]);
        $function = $mockCtor->getMock($functorParams);

        $function->expects($this->once())
            ->method('apply')
            ->with(...$arguments)
            ->willReturn($result)
        ;

        /**
         * @var FunctionInterface    $function
         * @var array<TermInterface> $arguments
         */
        $formula = new FunctionTerm($function, ...$terms);
        $this->assertSame($result, $formula->evaluate($environment));
    }
}
