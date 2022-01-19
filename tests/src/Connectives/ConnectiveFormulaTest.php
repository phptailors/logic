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
use Tailors\PHPUnit\ImplementsInterfaceTrait;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \Tailors\Logic\Connectives\ConnectiveFormula
 *
 * @uses \Tailors\Logic\AbstractFunctorExpression
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class ConnectiveFormulaTest extends TestCase
{
    use ImplementsInterfaceTrait;

    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testImplementsFormulaInterface(): void
    {
        $this->assertImplementsInterface(FormulaInterface::class, ConnectiveFormula::class);
    }

    public function testConnectiveReturnsProvidedConnective(): void
    {
        $p = $this->getMockBuilder(ConnectiveInterface::class)->getMock();

        /** @var ConnectiveInterface $p */
        $term = new ConnectiveFormula($p);
        $this->assertSame($p, $term->connective());
    }

    public function testFunctorReturnsProvidedConnective(): void
    {
        $p = $this->getMockBuilder(ConnectiveInterface::class)->getMock();

        /** @var ConnectiveInterface $p */
        $term = new ConnectiveFormula($p);
        $this->assertSame($p, $term->functor());
    }

    public function testArgumentsReturnsProvidedArguments(): void
    {
        $p = $this->getMockBuilder(ConnectiveInterface::class)->getMock();
        $t1 = $this->getMockBuilder(FormulaInterface::class)->getMock();
        $t2 = $this->getMockBuilder(FormulaInterface::class)->getMock();

        /** @var ConnectiveInterface $p */
        $term = new ConnectiveFormula($p, $t1, $t2);
        $this->assertSame([$t1, $t2], $term->arguments());
    }

    /**
     * @psalm-return array<array-key, array{0:array<string>, 1: string}>
     */
    public function providerExpressionStringReturnsFunctionExpression(): array
    {
        return [
            [[], ''],
            [['t1'], 't1'],
            [['t1', 't2'], 't1, t2'],
        ];
    }

    /**
     * @dataProvider providerExpressionStringReturnsFunctionExpression
     *
     * @psalm-param array<string> $symbols
     */
    public function testExpressionStringReturnsFunctionExpression(array $symbols, string $arglist): void
    {
        $arguments = array_map(function (string $symbol) {
            $term = $this->getMockBuilder(FormulaInterface::class)
                ->onlyMethods(['expressionString'])
                ->getMockForAbstractClass()
            ;
            $term->expects($this->once())
                ->method('expressionString')
                ->willReturn($symbol)
            ;

            return $term;
        }, $symbols);

        $p = $this->getMockBuilder(ConnectiveInterface::class)
            ->onlyMethods(['symbol'])
            ->getMockForAbstractClass()
        ;

        $p->expects($this->once())
            ->method('symbol')
            ->willReturn('p')
        ;

        /**
         * @var ConnectiveInterface     $p
         * @var array<FormulaInterface> $arguments
         */
        $term = new ConnectiveFormula($p, ...$arguments);
        $this->assertSame("p({$arglist})", $term->expressionString());
    }
}
