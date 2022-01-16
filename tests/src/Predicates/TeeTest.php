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
use Tailors\Logic\FunctionalInterface;
use Tailors\PHPUnit\ImplementsInterfaceTrait;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \Tailors\Logic\Predicates\Tee
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class TeeTest extends TestCase
{
    use ImplementsInterfaceTrait;

    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testImplementsPredicateInterface(): void
    {
        $this->assertImplementsInterface(PredicateInterface::class, Tee::class);
    }

    public function testImplementsFormulaInterface(): void
    {
        $this->assertImplementsInterface(FormulaInterface::class, Tee::class);
    }

    public function testArity(): void
    {
        $tee = new Tee();
        /** @psalm-suppress RedundantConditionGivenDocblockType */
        $this->assertSame(0, $tee->arity());
    }

    public function testApply(): void
    {
        $tee = new Tee();
        $this->assertTrue($tee->apply());
    }

    public function testSymbol(): void
    {
        $tee = new Tee();
        $this->assertSame('⊤', $tee->symbol());
    }

    public function testExpressionString(): void
    {
        $tee = new Tee();
        $this->assertSame('⊤', $tee->expressionString());
    }

    public function testNotation(): void
    {
        $tee = new Tee();
        /** @psalm-suppress RedundantConditionGivenDocblockType */
        $this->assertSame(FunctionalInterface::NOTATION_SYMBOL, $tee->notation());
    }
}
