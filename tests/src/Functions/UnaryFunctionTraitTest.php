<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

use PHPUnit\Framework\Attributes\CoversTrait;
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
#[CoversTrait(UnaryFunctionTrait::class)]
#[UsesMethod(AbstractFunctorExpression::class, '__construct')]
#[UsesMethod(AbstractFunctorExpression::class, 'arguments')]
#[UsesMethod(AbstractFunctorExpression::class, 'functor')]
#[UsesMethod(FunctionTerm::class, '__construct')]
#[UsesMethod(FunctionTerm::class, 'function')]
final class UnaryFunctionTraitTest extends TestCase
{
    #[\Override]
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testWith(): void
    {
        $t1 = $this->createMock(TermInterface::class);

        $unary = new UnaryFunctionTraitTestObject();
        $term = $unary->with($t1);
        $this->assertInstanceOf(FunctionTerm::class, $term);
        $this->assertSame($unary, $term->function());
        $this->assertSame([$t1], $term->arguments());
    }

    public function testArity(): void
    {
        $unary = new UnaryFunctionTraitTestObject();

        /** @psalm-suppress RedundantConditionGivenDocblockType */
        $this->assertSame(1, $unary->arity());
    }
}
