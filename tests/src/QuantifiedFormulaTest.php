<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tailors\PHPUnit\ImplementsInterfaceTrait;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 * @covers \Tailors\Logic\QuantifiedFormula
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class QuantifiedFormulaTest extends TestCase
{
    use ImplementsInterfaceTrait;

    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testImplementsFormulaInterface(): void
    {
        $this->assertImplementsInterface(FormulaInterface::class, QuantifiedFormula::class);
    }

    public function testFormulaReturnsProvidedFormula(): void
    {
        $formula = $this->getMockBuilder(FormulaInterface::class)->getMock();
        $quantified = new QuantifiedFormula($formula, []);
        $this->assertSame($formula, $quantified->formula());
    }

    public function testEnvironmentReturnsProvidedEnvironment(): void
    {
        $formula = $this->getMockBuilder(FormulaInterface::class)->getMock();
        $quantified = new QuantifiedFormula($formula, ['x' => 123]);
        $this->assertSame(['x' => 123], $quantified->environment());
    }

    public function testExpressionStringReturnsString(): void
    {
        /** @var MockObject&FormulaInterface */
        $formula = $this->getMockBuilder(FormulaInterface::class)
            ->onlyMethods(['expressionString'])
            ->getMockForAbstractClass()
        ;

        $formula->expects($this->once())
            ->method('expressionString')
            ->willReturn('foo')
        ;

        $quantified = new QuantifiedFormula($formula, []);
        $this->assertSame('foo', $quantified->expressionString());
    }

    public function testEvaluateInvokesFormulasEvaluate(): void
    {
        /** @var MockObject&FormulaInterface */
        $formula = $this->getMockBuilder(FormulaInterface::class)
            ->onlyMethods(['evaluate'])
            ->getMockForAbstractClass()
        ;

        $formula->expects($this->once())
            ->method('evaluate')
            ->with(['x' => 'X', 'y' => 'Y', 'z' => 'Z'])
            ->willReturn(true)
        ;

        $quantified = new QuantifiedFormula($formula, ['y' => 'Y', 'z' => 'Z']);
        $this->assertTrue($quantified->evaluate(['x' => 'X', 'y' => null]));
    }

    public function testWhereReturnsAnotherQuantifiedFormula(): void
    {
        $formula = $this->getMockBuilder(FormulaInterface::class)
            ->getMock()
        ;

        $quantified = new QuantifiedFormula($formula, ['x' => 'X']);
        $another = $quantified->where(['y' => 'Y']);
        $this->assertInstanceOf(QuantifiedFormula::class, $another);
        $this->assertNotSame($quantified, $another);
        $this->assertSame($quantified, $another->formula());
        $this->assertSame(['y' => 'Y'], $another->environment());
    }
}
