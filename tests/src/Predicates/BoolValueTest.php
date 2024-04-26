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
use PHPUnit\Framework\TestCase;
use Tailors\Logic\Exceptions\InvalidArgumentException;
use Tailors\Logic\FunctionNotationTrait;
use Tailors\Logic\FunctorInterface;
use Tailors\PHPUnit\ExtendsClassTrait;
use Tailors\PHPUnit\ImplementsInterfaceTrait;
use Tailors\PHPUnit\UsesTraitTrait;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 *
 * @coversNothing
 */
#[CoversClass(BoolValue::class)]
final class BoolValueTest extends TestCase
{
    use ImplementsInterfaceTrait;
    use ExtendsClassTrait;
    use UsesTraitTrait;

    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testImplementsPredicateInterface(): void
    {
        $this->assertImplementsInterface(PredicateInterface::class, BoolValue::class);
    }

    public function testExtendsAbstractPredicate(): void
    {
        $this->assertExtendsClass(AbstractPredicate::class, BoolValue::class);
    }

    public function testUsesFunctionNotationTrait(): void
    {
        $this->assertUsesTrait(FunctionNotationTrait::class, BoolValue::class);
    }

    public function testUsesUnaryPredicateTrait(): void
    {
        $this->assertUsesTrait(UnaryPredicateTrait::class, BoolValue::class);
    }

    public function testArity(): void
    {
        $bool = new BoolValue();

        /** @psalm-suppress RedundantConditionGivenDocblockType */
        $this->assertSame(1, $bool->arity());
    }

    /**
     * @psalm-return array<array-key, array{
     *  0: bool,
     *  1: list
     *  }>
     */
    public function providerApplyReturnsBool(): array
    {
        return [
            [
                false,
                [0],
            ],
            [
                false,
                [''],
            ],
            [
                false,
                [null],
            ],
            [
                false,
                [[]],
            ],
            [
                true,
                [1],
            ],
            [
                true,
                ['a'],
            ],
            [
                true,
                [new \stdClass()],
            ],
            [
                true,
                [[1, 2]],
            ],

            [
                true,
                [1, 0, 0],
            ],
        ];
    }

    /**
     * @uses \Tailors\Logic\Predicates\AbstractPredicate::apply
     *
     * @palm-param list $arguments
     */
    #[DataProvider('providerApplyReturnsBool')]
    public function testApplyReturnsBool(bool $result, array $arguments): void
    {
        $bool = new BoolValue();
        $this->assertSame($result, $bool->apply(...$arguments));
    }

    /**
     * @uses \Tailors\Logic\Predicates\AbstractPredicate::apply
     */
    public function testApplyThrowsInvalidArgumentException(): void
    {
        $bool = new BoolValue();
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('missing argument');
        $bool->apply();
    }

    public function testSymbol(): void
    {
        $bool = new BoolValue();
        $this->assertSame('bool', $bool->symbol());
    }

    public function testNotation(): void
    {
        $bool = new BoolValue();

        /** @psalm-suppress RedundantConditionGivenDocblockType */
        $this->assertSame(FunctorInterface::NOTATION_FUNCTION, $bool->notation());
    }

    public function testPrecedenceReturnValue(): void
    {
        $this->assertSame(0, (new BoolValue())->precedence());
    }
}
