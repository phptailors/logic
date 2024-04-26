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
use Tailors\Logic\InfixNotationTrait;
use Tailors\Logic\TermInterface;
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
 *
 * @coversNothing
 */
#[CoversClass(Sum::class)]
final class SumTest extends TestCase
{
    use ExtendsClassTrait;
    use UsesTraitTrait;

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

    /**
     * @uses \Tailors\Logic\Functions\AbstractNumericFunction::__construct
     */
    public function testSymbolReturnsPlusSign(): void
    {
        $validator = $this->getMockBuilder(NumbersArglistValidatorInterface::class)->getMock();
        $sum = new Sum($validator);
        $this->assertSame('+', $sum->symbol());
    }

    /**
     * @uses \Tailors\Logic\Functions\AbstractNumericFunction::__construct
     * @uses \Tailors\Logic\Functions\FunctionTerm::__construct
     * @uses \Tailors\Logic\AbstractFunctorExpression::__construct
     */
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
     * @uses \Tailors\Logic\Functions\AbstractNumericFunction::__construct
     * @uses \Tailors\Logic\Functions\AbstractNumericFunction::validate
     * @uses \Tailors\Logic\Functions\AbstractFunction::apply
     * @uses \Tailors\Logic\Validators\NumbersArglistValidator
     * @uses \Tailors\Logic\Validators\AbstractArglistValidator
     *
     * @psalm-param Number $result
     * @psalm-param array<Number> $arguments
     *
     * @param mixed $result
     */
    #[DataProvider('providerApplyReturnsSumOfArguments')]
    public function testApplyReturnsSumOfArguments($result, array $arguments): void
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

    /**
     * @uses \Tailors\Logic\Functions\AbstractNumericFunction::__construct
     */
    public function testPrecedenceReturnValue(): void
    {
        $validator = $this->getMockBuilder(NumbersArglistValidatorInterface::class)
            ->getMock()
        ;
        $this->assertSame(7, (new Sum($validator))->precedence());
    }
}
