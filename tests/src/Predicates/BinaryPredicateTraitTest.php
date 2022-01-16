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
 * @covers \Tailors\Logic\Predicates\BinaryPredicateTrait
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class BinaryPredicateTraitTest extends TestCase
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
        $t2 = $this->getMockBuilder(TermInterface::class)
            ->getMock()
        ;
        /** @var \PHPunit\Framework\MockObject\MockObject & BinaryPredicateTraitTestObject */
        $binary = $this->getMockBuilder(BinaryPredicateTraitTestObject::class)
            ->getMockForAbstractClass()
        ;
        $formula = $binary->with($t1, $t2);
        $this->assertInstanceOf(PredicateFormula::class, $formula);
        $this->assertSame($binary, $formula->predicate());
        $this->assertSame([$t1, $t2], $formula->arguments());
    }

    public function testArity(): void
    {
        /** @var \PHPunit\Framework\MockObject\MockObject & BinaryPredicateTraitTestObject */
        $binary = $this->getMockBuilder(BinaryPredicateTraitTestObject::class)
            ->getMockForAbstractClass()
        ;
        $this->assertSame(2, $binary->arity());
    }
}
