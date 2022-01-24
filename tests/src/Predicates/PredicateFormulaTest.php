<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Predicates;

use PHPUnit\Framework\TestCase;
use Tailors\Logic\FormulaInterface;
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
     * @psalm-return array<array-key, array{0:string, 1: string, 2: array<string>}>
     */
    public function providerExpressionStringReturnsString(): array
    {
        return [
            [
                '@',
                '@',
                [],
            ],
            [
                '@ t1',
                '@',
                ['t1'],
            ],
            [
                '@ t1 t2',
                '@',
                ['t1', 't2'],
            ],
        ];
    }

    /**
     * @dataProvider providerExpressionStringReturnsString
     *
     * @psalm-param array<string> $arguments
     */
    public function testExpressionStringReturnsString(string $result, string $symbol, array $arguments): void
    {
        $arguments = array_map(function (string $symbol) {
            $formula = $this->getMockBuilder(TermInterface::class)
                ->onlyMethods(['expressionString'])
                ->getMockForAbstractClass()
            ;
            $formula->expects($this->once())
                ->method('expressionString')
                ->willReturn($symbol)
            ;

            return $formula;
        }, $arguments);

        $predicate = $this->getMockBuilder(PredicateInterface::class)
            ->onlyMethods(['symbol'])
            ->getMockForAbstractClass()
        ;

        $predicate->expects($this->once())
            ->method('symbol')
            ->willReturn($symbol)
        ;

        /**
         * @var PredicateInterface   $predicate
         * @var array<TermInterface> $arguments
         */
        $formula = new PredicateFormula($predicate, ...$arguments);
        $this->assertSame($result, $formula->expressionString());
    }
}
