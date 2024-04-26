<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic;

use PHPUnit\Framework\TestCase;
use Tailors\PHPUnit\ImplementsInterfaceTrait;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @coversNothing
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class FunctorInterfaceTest extends TestCase
{
    use ImplementsInterfaceTrait;

    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testImplementsSymbolInterface(): void
    {
        $this->assertImplementsInterface(SymbolInterface::class, FunctorInterface::class);
    }

    public function testConstNotationPrefix(): void
    {
        $this->assertSame(0, FunctorInterface::NOTATION_PREFIX);
    }

    public function testConstNotationInfix(): void
    {
        $this->assertSame(1, FunctorInterface::NOTATION_INFIX);
    }

    public function testConstNotationSuffix(): void
    {
        $this->assertSame(2, FunctorInterface::NOTATION_SUFFIX);
    }

    public function testConstNotationSymbol(): void
    {
        $this->assertSame(3, FunctorInterface::NOTATION_SYMBOL);
    }

    public function testConstNotationFunction(): void
    {
        $this->assertSame(4, FunctorInterface::NOTATION_FUNCTION);
    }
}
