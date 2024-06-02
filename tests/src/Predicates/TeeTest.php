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
use PHPUnit\Framework\TestCase;
use Tailors\Logic\FormulaInterface;
use Tailors\Logic\FunctorInterface;
use Tailors\PHPUnit\ImplementsInterfaceTrait;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
#[CoversClass(Tee::class)]
final class TeeTest extends TestCase
{
    use ImplementsInterfaceTrait;

    #[\Override]
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
        $this->assertSame(FunctorInterface::NOTATION_SYMBOL, $tee->notation());
    }

    public function testPrecedenceReturnValue(): void
    {
        $this->assertSame(0, (new Tee())->precedence());
    }

    public function testEvaluateReturnsTrue(): void
    {
        $this->assertTrue((new Tee())->evaluate());
        $this->assertTrue((new Tee())->evaluate([]));
        $this->assertTrue((new Tee())->evaluate(['x' => 123]));
    }

    public function testWhereReturnsThis(): void
    {
        $falsum = new Tee();
        $this->assertSame($falsum, $falsum->where([]));
        $this->assertSame($falsum, $falsum->where(['x' => 123]));
    }
}
