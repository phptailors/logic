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
use Tailors\Logic\TermInterface;
use Tailors\PHPUnit\ExtendsClassTrait;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
#[CoversClass(GreaterThan::class)]
#[UsesMethod(AbstractPredicate::class, 'apply')]
#[UsesMethod(AbstractFunctorExpression::class, '__construct')]
#[UsesMethod(PredicateFormula::class, '__construct')]
final class GreaterThanTest extends TestCase
{
    use ExtendsClassTrait;

    #[\Override]
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testExtendsAbstractComparisonPredicate(): void
    {
        $this->assertExtendsClass(AbstractComparisonPredicate::class, GreaterThan::class);
    }

    public function testSymbolReturnsGreaterThanSign(): void
    {
        $sum = new GreaterThan();
        $this->assertSame('>', $sum->symbol());
    }

    public function testWithReturnsPredicateFormula(): void
    {
        $t1 = $this->getMockBuilder(TermInterface::class)->getMock();
        $t2 = $this->getMockBuilder(TermInterface::class)->getMock();
        $this->assertInstanceOf(PredicateFormula::class, (new GreaterThan())->with($t1, $t2));
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
            [false, [2, 2]],
            [true, [2, 1]],
            [false, [1.0, 2]],
            [false, [2.0, 2]],
            [true, [2.0, 1]],
            [false, [1, 2.0]],
            [false, [2, 2.0]],
            [true, [2, 1.0]],
            [false, [0, false]],
            [false, [false, 0]],
            [true, ['a', 'A']],
            [false, ['A', 'a']],
        ];
    }

    /**
     * @psalm-param list $arguments
     */
    #[DataProvider('providerApplyReturnsComparisonResult')]
    public function testApplyReturnsComparisonResults(mixed $result, array $arguments): void
    {
        $this->assertSame($result, (new GreaterThan())->apply(...$arguments));
    }

    public function testPrecedenceReturnValue(): void
    {
        $this->assertSame(11, (new GreaterThan())->precedence());
    }
}
