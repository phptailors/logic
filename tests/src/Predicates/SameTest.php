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
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\UsesMethod;
use PHPUnit\Framework\TestCase;
use Tailors\Logic\AbstractFunctorExpression;
use Tailors\Logic\InfixNotationTrait;
use Tailors\Logic\TermInterface;
use Tailors\PHPUnit\ExtendsClassTrait;
use Tailors\PHPUnit\UsesTraitTrait;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
#[CoversClass(Same::class)]
#[UsesMethod(AbstractPredicate::class, 'apply')]
#[UsesMethod(AbstractFunctorExpression::class, '__construct')]
#[UsesMethod(PredicateFormula::class, '__construct')]
final class SameTest extends TestCase
{
    use ExtendsClassTrait;
    use UsesTraitTrait;

    #[\Override]
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testExtendsAbstractPredicate(): void
    {
        $this->assertExtendsClass(AbstractPredicate::class, Same::class);
    }

    public function testUsesInfixNotationTrait(): void
    {
        $this->assertUsesTrait(InfixNotationTrait::class, Same::class);
    }

    public function testUsesBinaryPredicateTrait(): void
    {
        $this->assertUsesTrait(BinaryPredicateTrait::class, Same::class);
    }

    public function testSymbolReturnsStrictEqualSign(): void
    {
        $sum = new Same();
        $this->assertSame('===', $sum->symbol());
    }

    public function testWithReturnsPredicateFormula(): void
    {
        $t1 = $this->getMockBuilder(TermInterface::class)->getMock();
        $t2 = $this->getMockBuilder(TermInterface::class)->getMock();
        $this->assertInstanceOf(PredicateFormula::class, (new Same())->with($t1, $t2));
    }

    /**
     * @psalm-return array<array{0:mixed,1:list}>
     */
    public static function providerApplyReturnsComparisonResult(): array
    {
        return [
            [false, []],
            [false, [1]],
            [false, [1, 2]],
            [true, [2, 2]],
            [false, [2, '2']],
            [false, ['2', 2]],
            [true, [null, null]],
            [false, [false, null]],
            [false, [null, false]],
            [false, ['', null]],
            [false, [null, '']],
            [false, [0, false]],
            [false, [false, 0]],
        ];
    }

    /**
     * @psalm-param list $arguments
     */
    #[DataProvider('providerApplyReturnsComparisonResult')]
    public function testApplyReturnsComparisonResults(mixed $result, array $arguments): void
    {
        $this->assertSame($result, (new Same())->apply(...$arguments));
    }

    public function testPrecedenceReturnValue(): void
    {
        $this->assertSame(11, (new Same())->precedence());
    }
}
