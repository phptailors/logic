<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tailors\Logic\Exceptions\UndefinedVariableException;
use Tailors\PHPUnit\ImplementsInterfaceTrait;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
#[CoversClass(Variable::class)]
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

    public function testEvaluateReturnsValue(): void
    {
        $x = new Variable('x');
        $this->assertSame(10, $x->evaluate(['x' => 10]));
    }

    public function testEvaluateThrowsUndefinedVariableException(): void
    {
        $x = new Variable('x');

        $this->expectException(UndefinedVariableException::class);
        $this->expectExceptionMessage('undefined variable: x');

        $x->evaluate(['y' => 10]);
    }
}
