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

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 * @covers \Tailors\Logic\SymbolNotationTrait
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class SymbolNotationTraitTest extends TestCase
{
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testNotation(): void
    {
        $trait = new class() {
            use SymbolNotationTrait;
        };
        /** @psalm-suppress RedundantConditionGivenDocblockType */
        $this->assertSame(FunctorInterface::NOTATION_SYMBOL, $trait->notation());
    }
}
