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
use Tailors\Logic\TermInterface;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \Tailors\Logic\Predicates\UnaryPredicateTrait
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class UnaryPredicateTraitTest extends TestCase
{
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    /**
     * @uses \Tailors\Logic\FunctionalExpressionTrait::arguments
     * @uses \Tailors\Logic\Predicates\PredicateFormula::__construct
     * @uses \Tailors\Logic\Predicates\PredicateFormula::predicate
     */
    public function testWith(): void
    {
        $t1 = $this->getMockBuilder(TermInterface::class)
            ->getMock()
        ;
        /** @var \PHPUnit\Framework\MockObject\MockObject&UnaryPredicateTraitTestObject */
        $unary = $this->getMockBuilder(UnaryPredicateTraitTestObject::class)
            ->getMockForAbstractClass()
        ;
        $term = $unary->with($t1);
        $this->assertInstanceOf(PredicateFormula::class, $term);
        $this->assertSame($unary, $term->predicate());
        $this->assertSame([$t1], $term->arguments());
    }

    public function testArity(): void
    {
        /** @var \PHPUnit\Framework\MockObject\MockObject&UnaryPredicateTraitTestObject */
        $unary = $this->getMockBuilder(UnaryPredicateTraitTestObject::class)
            ->getMockForAbstractClass()
        ;
        $this->assertSame(1, $unary->arity());
    }
}
