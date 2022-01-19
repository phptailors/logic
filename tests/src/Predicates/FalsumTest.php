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
use Tailors\Logic\FunctorInterface;
use Tailors\PHPUnit\ImplementsInterfaceTrait;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \Tailors\Logic\Predicates\Falsum
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class FalsumTest extends TestCase
{
    use ImplementsInterfaceTrait;

    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testImplementsPredicateInterface(): void
    {
        $this->assertImplementsInterface(PredicateInterface::class, Falsum::class);
    }

    public function testImplementsFormulaInterface(): void
    {
        $this->assertImplementsInterface(FormulaInterface::class, Falsum::class);
    }

    public function testArity(): void
    {
        $falsum = new Falsum();
        /** @psalm-suppress RedundantConditionGivenDocblockType */
        $this->assertSame(0, $falsum->arity());
    }

    public function testApply(): void
    {
        $falsum = new Falsum();
        $this->assertFalse($falsum->apply());
    }

    public function testSymbol(): void
    {
        $falsum = new Falsum();
        $this->assertSame('⊥', $falsum->symbol());
    }

    public function testExpressionString(): void
    {
        $falsum = new Falsum();
        $this->assertSame('⊥', $falsum->expressionString());
    }

    public function testNotation(): void
    {
        $falsum = new Falsum();
        /** @psalm-suppress RedundantConditionGivenDocblockType */
        $this->assertSame(FunctorInterface::NOTATION_SYMBOL, $falsum->notation());
    }

    public function testPrecedenceReturnValue(): void
    {
        $this->assertSame(0, (new Falsum())->precedence());
    }
}
