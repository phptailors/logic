<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Connectives;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\UsesMethod;
use PHPUnit\Framework\TestCase;
use Tailors\Logic\AbstractFunctorExpression;
use Tailors\Logic\FormulaInterface;
use Tailors\Logic\InfixNotationTrait;
use Tailors\PHPUnit\ImplementsInterfaceTrait;
use Tailors\PHPUnit\UsesTraitTrait;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
#[CoversClass(Disjunction::class)]
#[UsesMethod(ConnectiveFormula::class, '__construct')]
#[UsesMethod(AbstractFunctorExpression::class, '__construct')]
final class DisjunctionTest extends TestCase
{
    use ImplementsInterfaceTrait;
    use UsesTraitTrait;

    #[\Override]
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testImplementsConnectiveInterface(): void
    {
        $this->assertImplementsInterface(ConnectiveInterface::class, Disjunction::class);
    }

    public function testUsesInfixNotationTrait(): void
    {
        $this->assertUsesTrait(InfixNotationTrait::class, Disjunction::class);
    }

    public function testUsesBinaryConnectiveTrait(): void
    {
        $this->assertUsesTrait(BinaryConnectiveTrait::class, Disjunction::class);
    }

    public function testSymbolReturnsDoubleAnd(): void
    {
        $sub = new Disjunction();
        $this->assertSame('||', $sub->symbol());
    }

    public function testWithReturnsConnectiveFormula(): void
    {
        $t1 = $this->getMockBuilder(FormulaInterface::class)->getMock();
        $t2 = $this->getMockBuilder(FormulaInterface::class)->getMock();
        $this->assertInstanceOf(ConnectiveFormula::class, (new Disjunction())->with($t1, $t2));
    }

    /**
     * @psalm-return array<array{0:bool,1:array<bool>}>
     */
    public static function providerApplyReturnsDisjunctionOfArguments(): array
    {
        return [
            [false, []],
            [true, [true]],
            [false, [false]],
            [true, [true, true]],
            [true, [false, true]],
            [true, [true, false]],
            [false, [false, false]],
            [true, [true, true, true]],
            [true, [false, true, true]],
            [true, [true, false, true]],
            [true, [true, true, false]],
            [true, [true, false, false]],
            [true, [false, true, false]],
            [true, [false, false, true]],
            [false, [false, false, false]],
        ];
    }

    /**
     * @psalm-param array<bool> $arguments
     */
    #[DataProvider('providerApplyReturnsDisjunctionOfArguments')]
    public function testApplyReturnsDisjunctionOfArguments(bool $result, array $arguments): void
    {
        $this->assertSame($result, (new Disjunction())->apply(...$arguments));
    }

    public function testPrecedenceReturnValue(): void
    {
        $this->assertSame(16, (new Disjunction())->precedence());
    }
}
