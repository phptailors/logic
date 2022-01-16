<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic;

use PHPUnit\Framework\TestCase;
use Tailors\PHPUnit\ImplementsInterfaceTrait;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \Tailors\Logic\Variable
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class VariableTest extends TestCase
{
    use ImplementsInterfaceTrait;

    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testImplementsVariableInterface(): void
    {
        $this->assertImplementsInterface(VariableInterface::class, Variable::class);
    }

    public function testSymbolReturnsProvidedSymbolString(): void
    {
        $x = new Variable('x');
        $this->assertSame('x', $x->symbol());
    }

    public function testExpressionStringReturnsSymbol(): void
    {
        $x = new Variable('x');
        $this->assertSame('x', $x->expressionString());
    }
}
