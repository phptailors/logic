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
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\UsesMethod;
use PHPUnit\Framework\TestCase;
use Tailors\Logic\AbstractFunctorExpression;
use Tailors\Logic\InfixNotationTrait;
use Tailors\Logic\TermInterface;
use Tailors\Logic\Validators\AbstractArglistValidator;
use Tailors\Logic\Validators\NumbersArglistValidator;
use Tailors\Logic\Validators\NumbersArglistValidatorInterface;
use Tailors\PHPUnit\ExtendsClassTrait;
use Tailors\PHPUnit\UsesTraitTrait;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @psalm-import-type Number from Sum
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
#[CoversClass(Sum::class)]
#[UsesClass(AbstractArglistValidator::class)]
#[UsesClass(NumbersArglistValidator::class)]
#[UsesMethod(AbstractFunction::class, 'apply')]
#[UsesMethod(AbstractFunctorExpression::class, '__construct')]
#[UsesMethod(AbstractNumericFunction::class, '__construct')]
#[UsesMethod(AbstractNumericFunction::class, '__construct')]
#[UsesMethod(AbstractNumericFunction::class, 'validate')]
#[UsesMethod(FunctionTerm::class, '__construct')]
final class SumTest extends TestCase
{
    use ExtendsClassTrait;
    use UsesTraitTrait;

    #[\Override]
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testExtendsAbstractNumericFunction(): void
    {
        $this->assertExtendsClass(AbstractNumericFunction::class, Sum::class);
    }

    public function testUsesInfixNotationTrait(): void
    {
        $this->assertUsesTrait(InfixNotationTrait::class, Sub::class);
    }

    public function testUsesBinaryFunctionTrait(): void
    {
        $this->assertUsesTrait(BinaryFunctionTrait::class, Sub::class);
    }

    public function testSymbolReturnsPlusSign(): void
    {
        $validator = $this->getMockBuilder(NumbersArglistValidatorInterface::class)->getMock();
        $sum = new Sum($validator);
        $this->assertSame('+', $sum->symbol());
    }

    public function testWithReturnsFunctionTerm(): void
    {
        $validator = $this->getMockBuilder(NumbersArglistValidatorInterface::class)->getMock();
        $t1 = $this->getMockBuilder(TermInterface::class)->getMock();
        $t2 = $this->getMockBuilder(TermInterface::class)->getMock();
        $this->assertInstanceOf(FunctionTerm::class, (new Sum($validator))->with($t1, $t2));
    }

    /**
     * @psalm-return array<array{0:Number,1:array<Number>}>
     */
    public static function providerApplyReturnsSumOfArguments(): array
    {
        return [
            [0, []],
            [1, [1]],
            [3, [1, 2]],
            [6, [1, 2, 3]],
            [6.1, [1.1, 2, 3]],
            [6.2, [1, 2.2, 3]],
            [6.3, [1, 2, 3.3]],
        ];
    }

    /**
     * @psalm-param Number $result
     * @psalm-param array<Number> $arguments
     */
    #[DataProvider('providerApplyReturnsSumOfArguments')]
    public function testApplyReturnsSumOfArguments(mixed $result, array $arguments): void
    {
        $validator = $this->getMockBuilder(NumbersArglistValidatorInterface::class)
            ->onlyMethods(['validate'])
            ->getMock()
        ;

        $validator->expects($this->once())
            ->method('validate')
            ->with('+', $arguments)
        ;

        $this->assertSame($result, (new Sum($validator))->apply(...$arguments));
    }

    public function testPrecedenceReturnValue(): void
    {
        $validator = $this->getMockBuilder(NumbersArglistValidatorInterface::class)
            ->getMock()
        ;
        $this->assertSame(7, (new Sum($validator))->precedence());
    }
}
