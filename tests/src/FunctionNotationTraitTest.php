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

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 *
 * @coversNothing
 */
#[CoversClass(FunctionNotationTrait::class)]
final class FunctionNotationTraitTest extends TestCase
{
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testNotation(): void
    {
        $trait = new class() {
            use FunctionNotationTrait;
        };

        /** @psalm-suppress RedundantConditionGivenDocblockType */
        $this->assertSame(FunctorInterface::NOTATION_FUNCTION, $trait->notation());
    }

    public function testPrecedence(): void
    {
        $trait = new class() {
            use FunctionNotationTrait;
        };

        /** @psalm-suppress RedundantConditionGivenDocblockType */
        $this->assertSame(0, $trait->precedence());
    }
}
