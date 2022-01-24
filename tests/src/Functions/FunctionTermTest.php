<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

use PHPUnit\Framework\TestCase;
use Tailors\Logic\TermInterface;
use Tailors\PHPUnit\ImplementsInterfaceTrait;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \Tailors\Logic\Functions\FunctionTerm
 *
 * @uses \Tailors\Logic\AbstractFunctorExpression
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class FunctionTermTest extends TestCase
{
    use ImplementsInterfaceTrait;

    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testImplementsTermInterface(): void
    {
        $this->assertImplementsInterface(TermInterface::class, FunctionTerm::class);
    }

    public function testFunctionReturnsProvidedFunction(): void
    {
        $f = $this->getMockBuilder(FunctionInterface::class)->getMock();

        /** @var FunctionInterface $f */
        $term = new FunctionTerm($f);
        $this->assertSame($f, $term->function());
    }

    public function testFunctorReturnsProvidedFunction(): void
    {
        $f = $this->getMockBuilder(FunctionInterface::class)->getMock();

        /** @var FunctionInterface $f */
        $term = new FunctionTerm($f);
        $this->assertSame($f, $term->functor());
    }

    public function testArgumentsReturnsProvidedArguments(): void
    {
        $f = $this->getMockBuilder(FunctionInterface::class)->getMock();
        $t1 = $this->getMockBuilder(TermInterface::class)->getMock();
        $t2 = $this->getMockBuilder(TermInterface::class)->getMock();

        /** @var FunctionInterface $f */
        $term = new FunctionTerm($f, $t1, $t2);
        $this->assertSame([$t1, $t2], $term->arguments());
    }

    /**
     * @psalm-return array<array-key, array{0:string, 1: string, 2: array<string>}>
     */
    public function providerExpressionStringReturnsString(): array
    {
        return [
            [
                '@',
                '@',
                [],
            ],
            [
                '@ t1',
                '@',
                ['t1'],
            ],
            [
                '@ t1 t2',
                '@',
                ['t1', 't2'],
            ],
        ];
    }

    /**
     * @dataProvider providerExpressionStringReturnsString
     *
     * @psalm-param array<string> $arguments
     */
    public function testExpressionStringReturnsString(string $result, string $symbol, array $arguments): void
    {
        $arguments = array_map(function (string $symbol) {
            $term = $this->getMockBuilder(TermInterface::class)
                ->onlyMethods(['expressionString'])
                ->getMockForAbstractClass()
            ;
            $term->expects($this->once())
                ->method('expressionString')
                ->willReturn($symbol)
            ;

            return $term;
        }, $arguments);

        $function = $this->getMockBuilder(FunctionInterface::class)
            ->onlyMethods(['symbol'])
            ->getMockForAbstractClass()
        ;

        $function->expects($this->once())
            ->method('symbol')
            ->willReturn($symbol)
        ;

        /**
         * @var FunctionInterface    $function
         * @var array<TermInterface> $arguments
         */
        $term = new FunctionTerm($function, ...$arguments);
        $this->assertSame($result, $term->expressionString());
    }
}
