<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Tailors\Logic\FunctorInterface;
use Tailors\Logic\SymbolNotationTrait;
use Tailors\Logic\TermInterface;
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
#[CoversClass(Constant::class)]
final class ConstantTest extends TestCase
{
    use ImplementsInterfaceTrait;
    use UsesTraitTrait;

    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testImplementsFunctionInterface(): void
    {
        $this->assertImplementsInterface(FunctionInterface::class, Constant::class);
    }

    public function testImplementsTermInterface(): void
    {
        $this->assertImplementsInterface(TermInterface::class, Constant::class);
    }

    public function testUsesSymbolNotationTrait(): void
    {
        $this->assertUsesTrait(SymbolNotationTrait::class, Constant::class);
    }

    public function testArity(): void
    {
        $const = new Constant(1);

        /** @psalm-suppress RedundantConditionGivenDocblockType */
        $this->assertSame(0, $const->arity());
    }

    public function testApply(): void
    {
        $const = new Constant(123);

        /** @psalm-suppress RedundantConditionGivenDocblockType */
        $this->assertSame(123, $const->apply());
        $this->assertSame(123, $const->apply('x'));
        $this->assertSame(123, $const->apply('x', 'y'));
    }

    public function testSymbol(): void
    {
        $const = new Constant(0);
        $this->assertSame('const', $const->symbol());
    }

    /**
     * @psalm-return array<array-key, array{0: mixed, 1: string}>
     */
    public function providerExpressionString(): array
    {
        return [
            [123, '123'],
            ['a', "'a'"],
        ];
    }

    /**
     * @param mixed $value
     */
    #[DataProvider('providerExpressionString')]
    public function testExpressionString($value, string $result): void
    {
        $const = new Constant($value);
        $this->assertSame($result, $const->expressionString());
    }

    public function testNotation(): void
    {
        $const = new Constant(0);

        /** @psalm-suppress RedundantConditionGivenDocblockType */
        $this->assertSame(FunctorInterface::NOTATION_SYMBOL, $const->notation());
    }

    public function testPrecedenceReturnValue(): void
    {
        $this->assertSame(0, (new Constant(0))->precedence());
    }

    public function testEvaluateReturnsValue(): void
    {
        $this->assertSame(12, (new Constant(12))->evaluate());
        $this->assertSame(12, (new Constant(12))->evaluate([]));
        $this->assertSame(12, (new Constant(12))->evaluate(['x' => 123]));
    }
}
