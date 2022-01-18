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

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \Tailors\Logic\InfixNotationTrait
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class InfixNotationTraitTest extends TestCase
{
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testNotation(): void
    {
        $trait = new class() {
            use InfixNotationTrait;
        };
        /** @psalm-suppress RedundantConditionGivenDocblockType */
        $this->assertSame(FunctionalInterface::NOTATION_INFIX, $trait->notation());
    }
}