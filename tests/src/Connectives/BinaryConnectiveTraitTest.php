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
 * @covers \Tailors\Logic\Connectives\BinaryConnectiveTrait
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class BinaryConnectiveTraitTest extends TestCase
{
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    /**
     * @uses \Tailors\Logic\Connectives\ConnectiveFormula::__construct
     * @uses \Tailors\Logic\Connectives\ConnectiveFormula::connective
     * @uses \Tailors\Logic\AbstractFunctorExpression::__construct
     * @uses \Tailors\Logic\AbstractFunctorExpression::arguments
     * @uses \Tailors\Logic\AbstractFunctorExpression::functor
     */
    public function testWith(): void
    {
        $t1 = $this->getMockBuilder(FormulaInterface::class)
            ->getMock()
        ;
        $t2 = $this->getMockBuilder(FormulaInterface::class)
            ->getMock()
        ;
        /** @var \PHPunit\Framework\MockObject\MockObject & BinaryConnectiveTraitTestObject */
        $binary = $this->getMockBuilder(BinaryConnectiveTraitTestObject::class)
            ->getMockForAbstractClass()
        ;
        $formula = $binary->with($t1, $t2);
        $this->assertInstanceOf(ConnectiveFormula::class, $formula);
        $this->assertSame($binary, $formula->connective());
        $this->assertSame([$t1, $t2], $formula->arguments());
    }

    public function testArity(): void
    {
        /** @var \PHPunit\Framework\MockObject\MockObject & BinaryConnectiveTraitTestObject */
        $binary = $this->getMockBuilder(BinaryConnectiveTraitTestObject::class)
            ->getMockForAbstractClass()
        ;
        $this->assertSame(2, $binary->arity());
    }
}
