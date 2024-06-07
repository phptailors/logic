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
#[CoversClass(Equal::class)]
#[UsesMethod(AbstractPredicate::class, 'apply')]
#[UsesMethod(AbstractFunctorExpression::class, '__construct')]
#[UsesMethod(PredicateFormula::class, '__construct')]
final class EqualTest extends TestCase
{
    use ExtendsClassTrait;

    #[\Override]
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testExtendsAbstractComparisonPredicate(): void
    {
        $this->assertExtendsClass(AbstractComparisonPredicate::class, Equal::class);
    }

    public function testSymbolReturnsEqualSign(): void
    {
        $sum = new Equal();
        $this->assertSame('==', $sum->symbol());
    }

    public function testWithReturnsPredicateFormula(): void
    {
        $t1 = $this->getMockBuilder(TermInterface::class)->getMock();
        $t2 = $this->getMockBuilder(TermInterface::class)->getMock();
        $this->assertInstanceOf(PredicateFormula::class, (new Equal())->with($t1, $t2));
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
            [true, [2, '2']],
            [true, ['2', 2]],
            [true, [null, null]],
            [true, [false, null]],
            [true, [null, false]],
            [true, ['', null]],
            [true, [null, '']],
            [true, [0, false]],
            [true, [false, 0]],
            [false, ['a', 'A']],
        ];
    }

    /**
     * @psalm-param list $arguments
     */
    #[DataProvider('providerApplyReturnsComparisonResult')]
    public function testApplyReturnsComparisonResults(mixed $result, array $arguments): void
    {
        $this->assertSame($result, (new Equal())->apply(...$arguments));
    }

    public function testPrecedenceReturnValue(): void
    {
        $this->assertSame(11, (new Equal())->precedence());
    }
}
