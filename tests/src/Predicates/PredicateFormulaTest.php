<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Predicates;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tailors\Logic\FormulaInterface;
use Tailors\Logic\FunctorInterface;
use Tailors\Logic\FunctorMockConstructor;
use Tailors\Logic\QuantifiedFormula;
use Tailors\Logic\TermInterface;
use Tailors\PHPUnit\ImplementsInterfaceTrait;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \Tailors\Logic\Predicates\PredicateFormula
 *
 * @uses \Tailors\Logic\AbstractFunctorExpression
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @psalm-import-type FunctorMockParams from FunctorMockConstructor
 *
 * @internal
 */
final class PredicateFormulaTest extends TestCase
{
    use ImplementsInterfaceTrait;

    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testImplementsFormulaInterface(): void
    {
        $this->assertImplementsInterface(FormulaInterface::class, PredicateFormula::class);
    }

    public function testPredicateReturnsProvidedPredicate(): void
    {
        $p = $this->getMockBuilder(PredicateInterface::class)->getMock();

        /** @var PredicateInterface $p */
        $term = new PredicateFormula($p);
        $this->assertSame($p, $term->predicate());
    }

    public function testFunctorReturnsProvidedPredicate(): void
    {
        $p = $this->getMockBuilder(PredicateInterface::class)->getMock();

        /** @var PredicateInterface $p */
        $term = new PredicateFormula($p);
        $this->assertSame($p, $term->functor());
    }

    public function testArgumentsReturnsProvidedArguments(): void
    {
        $p = $this->getMockBuilder(PredicateInterface::class)->getMock();
        $t1 = $this->getMockBuilder(TermInterface::class)->getMock();
        $t2 = $this->getMockBuilder(TermInterface::class)->getMock();

        /** @var PredicateInterface $p */
        $term = new PredicateFormula($p, $t1, $t2);
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
        $terms = array_map(
            /**
             * @psalm-return MockObject&TermInterface
             */
            function (string $symbol): MockObject {
                /** @psalm-var  MockObject&TermInterface */
                $term = $this->getMockBuilder(TermInterface::class)
                    ->onlyMethods(['expressionString'])
                    ->getMockForAbstractClass()
                            ;
                $term->expects($this->once())
                    ->method('expressionString')
                    ->willReturn($symbol)
                    ;

                return $term;
            },
            $arguments
        );

        $mockCtor = new FunctorMockConstructor($this, PredicateInterface::class, ['apply' => true]);
        $predicate = $mockCtor->getMock($functorParams);

        /**
         * @var PredicateInterface   $predicate
         * @var array<TermInterface> $terms
         */
        $formula = new PredicateFormula($predicate, ...$terms);
        $this->assertSame($result, $formula->expressionString());
    }

    /**
     * @psalm-return array<array-key, array{
     *  0: bool,
     *  1: FunctorMockParams,
     *  2: list,
     *  3: array<string,mixed>
     * }>
     */
    public function providerEvaluateReturnsBool(): array
    {
        return [
            [
                false,
                [],
                [],
                [],
            ],
            [
                true,
                [],
                [],
                [],
            ],
            [
                false,
                [],
                ['x', 'y', 'z'],
                ['x' => 123],
            ],
        ];
    }

    /**
     * @dataProvider providerEvaluateReturnsBool
     * @psalm-param FunctorMockParams $functorParams
     * @psalm-param list $arguments
     * @psalm-param array<string, mixed> $environment
     */
    public function testEvaluateReturnsBool(
        bool $result,
        array $functorParams,
        array $arguments,
        array $environment
    ): void {
        $terms = array_map(
            /**
             * @param mixed $argument
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

        $mockCtor = new FunctorMockConstructor($this, PredicateInterface::class, ['apply' => false]);
        $predicate = $mockCtor->getMock($functorParams);

        $predicate->expects($this->once())
            ->method('apply')
            ->with(...$arguments)
            ->willReturn($result)
        ;

        /**
         * @var PredicateInterface   $predicate
         * @var array<TermInterface> $arguments
         */
        $formula = new PredicateFormula($predicate, ...$terms);
        $this->assertSame($result, $formula->evaluate($environment));
    }

    /**
     * @uses \Tailors\Logic\QuantifiedFormula::__construct
     * @uses \Tailors\Logic\QuantifiedFormula::environment
     */
    public function testWhereReturnsQuantifiedFormula(): void
    {
        $terms = [$this->getMockBuilder(TermInterface::class)->getMock()];
        $predicate = $this->getMockBuilder(PredicateInterface::class)->getMock();
        $formula = new PredicateFormula($predicate, ...$terms);
        $quantified = $formula->where(['x' => 123]);
        $this->assertInstanceOf(QuantifiedFormula::class, $quantified);
        $this->assertSame(['x' => 123], $quantified->environment());
    }
}
