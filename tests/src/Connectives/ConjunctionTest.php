<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Connectives;

use PHPUnit\Framework\TestCase;
use Tailors\Logic\FormulaInterface;
use Tailors\Logic\InfixNotationTrait;
use Tailors\PHPUnit\ImplementsInterfaceTrait;
use Tailors\PHPUnit\UsesTraitTrait;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \Tailors\Logic\Connectives\Conjunction
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class ConjunctionTest extends TestCase
{
    use ImplementsInterfaceTrait;
    use UsesTraitTrait;

    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testImplementsConnectiveInterface(): void
    {
        $this->assertImplementsInterface(ConnectiveInterface::class, Conjunction::class);
    }

    public function testUsesInfixNotationTrait(): void
    {
        $this->assertUsesTrait(InfixNotationTrait::class, Conjunction::class);
    }

    public function testUsesBinaryConnectiveTrait(): void
    {
        $this->assertUsesTrait(BinaryConnectiveTrait::class, Conjunction::class);
    }

    public function testSymbolReturnsDoubleAnd(): void
    {
        $sub = new Conjunction();
        $this->assertSame('&&', $sub->symbol());
    }

    /**
     * @uses \Tailors\Logic\Connectives\ConnectiveFormula::__construct
     */
    public function testWithReturnsConnectiveFormula(): void
    {
        $t1 = $this->getMockBuilder(FormulaInterface::class)->getMock();
        $t2 = $this->getMockBuilder(FormulaInterface::class)->getMock();
        $this->assertInstanceOf(ConnectiveFormula::class, (new Conjunction())->with($t1, $t2));
    }

    /**
     * @psalm-return array<array{0:bool,1:array<bool>}>
     */
    public static function providerApplyReturnsConjunctionOfArguments(): array
    {
        return [
            [false, []],
            [true, [true]],
            [false, [false]],
            [true, [true, true]],
            [false, [false, true]],
            [false, [true, false]],
            [false, [false, false]],
            [true, [true, true, true]],
            [false, [false, true, true]],
            [false, [true, false, true]],
            [false, [true, true, false]],
            [false, [true, false, false]],
            [false, [false, true, false]],
            [false, [false, false, true]],
            [false, [false, false, false]],
        ];
    }

    /**
     * @dataProvider providerApplyReturnsConjunctionOfArguments
     *
     * @psalm-param array<bool> $arguments
     *
     * @param mixed $result
     */
    public function testApplyReturnsConjunctionOfArguments(bool $result, array $arguments): void
    {
        $this->assertSame($result, (new Conjunction())->apply(...$arguments));
    }
}