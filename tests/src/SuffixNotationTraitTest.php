<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic;

use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\TestCase;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
#[CoversTrait(SuffixNotationTrait::class)]
final class SuffixNotationTraitTest extends TestCase
{
    #[\Override]
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testNotation(): void
    {
        $trait = new class() {
            use SuffixNotationTrait;
        };

        /** @psalm-suppress RedundantConditionGivenDocblockType */
        $this->assertSame(FunctorInterface::NOTATION_SUFFIX, $trait->notation());
    }
}
