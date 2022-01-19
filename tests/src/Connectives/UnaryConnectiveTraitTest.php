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

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \Tailors\Logic\Connectives\UnaryConnectiveTrait
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class UnaryConnectiveTraitTest extends TestCase
{
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    /**
     * @uses \Tailors\Logic\FunctorExpressionTrait::arguments
     * @uses \Tailors\Logic\Connectives\ConnectiveFormula::__construct
     * @uses \Tailors\Logic\Connectives\ConnectiveFormula::connective
     */
    public function testWith(): void
    {
        $t1 = $this->getMockBuilder(FormulaInterface::class)
            ->getMock()
        ;
        /** @var \PHPUnit\Framework\MockObject\MockObject&UnaryConnectiveTraitTestObject */
        $unary = $this->getMockBuilder(UnaryConnectiveTraitTestObject::class)
            ->getMockForAbstractClass()
        ;
        $term = $unary->with($t1);
        $this->assertInstanceOf(ConnectiveFormula::class, $term);
        $this->assertSame($unary, $term->connective());
        $this->assertSame([$t1], $term->arguments());
    }

    public function testArity(): void
    {
        /** @var \PHPUnit\Framework\MockObject\MockObject&UnaryConnectiveTraitTestObject */
        $unary = $this->getMockBuilder(UnaryConnectiveTraitTestObject::class)
            ->getMockForAbstractClass()
        ;
        $this->assertSame(1, $unary->arity());
    }
}
