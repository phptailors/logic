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
#[CoversClass(UnaryPredicateTrait::class)]
#[UsesMethod(AbstractFunctorExpression::class, '__construct')]
#[UsesMethod(AbstractFunctorExpression::class, 'arguments')]
#[UsesMethod(AbstractFunctorExpression::class, 'functor')]
#[UsesMethod(PredicateFormula::class, '__construct')]
#[UsesMethod(PredicateFormula::class, 'predicate')]
final class UnaryPredicateTraitTest extends TestCase
{
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testWith(): void
    {
        $t1 = $this->createMock(TermInterface::class);

        $unary = new UnaryPredicateTraitTestObject();
        $term = $unary->with($t1);
        $this->assertInstanceOf(PredicateFormula::class, $term);
        $this->assertSame($unary, $term->predicate());
        $this->assertSame([$t1], $term->arguments());
    }

    public function testArity(): void
    {
        $unary = new UnaryPredicateTraitTestObject();

        /** @psalm-suppress RedundantConditionGivenDocblockType */
        $this->assertSame(1, $unary->arity());
    }
}
