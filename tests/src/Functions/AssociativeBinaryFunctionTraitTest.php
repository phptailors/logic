<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

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
#[CoversClass(AssociativeBinaryFunctionTrait::class)]
#[UsesMethod(AbstractFunctorExpression::class, '__construct')]
#[UsesMethod(AbstractFunctorExpression::class, 'arguments')]
#[UsesMethod(AbstractFunctorExpression::class, 'functor')]
#[UsesMethod(FunctionTerm::class, '__construct')]
#[UsesMethod(FunctionTerm::class, 'function')]
final class AssociativeBinaryFunctionTraitTest extends TestCase
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

        $binary = new AssociativeBinaryFunctionTraitTestObject();
        $term = $binary->with($t1, $t2);
        $this->assertInstanceOf(FunctionTerm::class, $term);
        $this->assertSame($binary, $term->function());
        $this->assertSame([$t1, $t2], $term->arguments());
    }

    public function testWithAssociative(): void
    {
        // more than 2 arguments shall be possible for associative

        $t1 = $this->createMock(TermInterface::class);
        $t2 = $this->createMock(TermInterface::class);
        $t3 = $this->createMock(TermInterface::class);
        $t4 = $this->createMock(TermInterface::class);

        $binary = new AssociativeBinaryFunctionTraitTestObject();
        $term = $binary->with($t1, $t2, $t3, $t4);
        $this->assertInstanceOf(FunctionTerm::class, $term);
        $this->assertSame($binary, $term->function());
        $this->assertSame([$t1, $t2, $t3, $t4], $term->arguments());
    }

    public function testArity(): void
    {
        $binary = new AssociativeBinaryFunctionTraitTestObject();

        /** @psalm-suppress RedundantConditionGivenDocblockType */
        $this->assertSame(2, $binary->arity());
    }
}
