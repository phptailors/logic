<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Predicates;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesMethod;
use PHPUnit\Framework\TestCase;
use Tailors\Logic\AbstractFunctorExpression;
use Tailors\Logic\TermInterface;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
#[CoversClass(BinaryPredicateTrait::class)]
#[UsesMethod(AbstractFunctorExpression::class, '__construct')]
#[UsesMethod(AbstractFunctorExpression::class, 'arguments')]
#[UsesMethod(AbstractFunctorExpression::class, 'functor')]
#[UsesMethod(PredicateFormula::class, '__construct')]
#[UsesMethod(PredicateFormula::class, 'predicate')]
final class BinaryPredicateTraitTest extends TestCase
{
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testWith(): void
    {
        $t1 = $this->getMockBuilder(TermInterface::class)
            ->getMock()
        ;
        $t2 = $this->getMockBuilder(TermInterface::class)
            ->getMock()
        ;

        /** @var BinaryPredicateTraitTestObject&\PHPUnit\Framework\MockObject\MockObject */
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
        /** @var BinaryPredicateTraitTestObject&\PHPUnit\Framework\MockObject\MockObject */
        $binary = $this->getMockBuilder(BinaryPredicateTraitTestObject::class)
            ->getMockForAbstractClass()
        ;
        $this->assertSame(2, $binary->arity());
    }
}
