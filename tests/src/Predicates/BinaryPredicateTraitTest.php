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
    #[\Override]
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testWith(): void
    {
        $t1 = $this->createMock(TermInterface::class);
        $t2 = $this->createMock(TermInterface::class);

        $binary = new BinaryPredicateTraitTestObject();
        $formula = $binary->with($t1, $t2);
        $this->assertInstanceOf(PredicateFormula::class, $formula);
        $this->assertSame($binary, $formula->predicate());
        $this->assertSame([$t1, $t2], $formula->arguments());
    }

    public function testArity(): void
    {
        $binary = new BinaryPredicateTraitTestObject();

        /** @psalm-suppress RedundantConditionGivenDocblockType */
        $this->assertSame(2, $binary->arity());
    }
}
