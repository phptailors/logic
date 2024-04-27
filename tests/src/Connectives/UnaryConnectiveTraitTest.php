<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Connectives;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesMethod;
use PHPUnit\Framework\TestCase;
use Tailors\Logic\AbstractFunctorExpression;
use Tailors\Logic\FormulaInterface;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
#[CoversClass(UnaryConnectiveTrait::class)]
#[UsesMethod(AbstractFunctorExpression::class, '__construct')]
#[UsesMethod(AbstractFunctorExpression::class, 'arguments')]
#[UsesMethod(AbstractFunctorExpression::class, 'functor')]
#[UsesMethod(ConnectiveFormula::class, '__construct')]
#[UsesMethod(ConnectiveFormula::class, 'connective')]
final class UnaryConnectiveTraitTest extends TestCase
{
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testWith(): void
    {
        $t1 = $this->createMock(FormulaInterface::class);

        $unary = new UnaryConnectiveTraitTestObject();
        $term = $unary->with($t1);
        $this->assertInstanceOf(ConnectiveFormula::class, $term);
        $this->assertSame($unary, $term->connective());
        $this->assertSame([$t1], $term->arguments());
    }

    public function testArity(): void
    {
        $unary = new UnaryConnectiveTraitTestObject();
        $this->assertSame(1, $unary->arity());
    }
}
