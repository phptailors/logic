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

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \Tailors\Logic\Functions\UnaryFunctionTrait
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class UnaryFunctionTraitTest extends TestCase
{
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    /**
     * @uses \Tailors\Logic\AbstractFunctorExpression::__construct
     * @uses \Tailors\Logic\AbstractFunctorExpression::arguments
     * @uses \Tailors\Logic\AbstractFunctorExpression::functor
     * @uses \Tailors\Logic\Functions\FunctionTerm::__construct
     * @uses \Tailors\Logic\Functions\FunctionTerm::function
     */
    public function testWith(): void
    {
        $t1 = $this->getMockBuilder(TermInterface::class)
            ->getMock()
        ;
        /** @var \PHPUnit\Framework\MockObject\MockObject&UnaryFunctionTraitTestObject */
        $unary = $this->getMockBuilder(UnaryFunctionTraitTestObject::class)
            ->getMockForAbstractClass()
        ;
        $term = $unary->with($t1);
        $this->assertInstanceOf(FunctionTerm::class, $term);
        $this->assertSame($unary, $term->function());
        $this->assertSame([$t1], $term->arguments());
    }

    public function testArity(): void
    {
        /** @var \PHPUnit\Framework\MockObject\MockObject&UnaryFunctionTraitTestObject */
        $unary = $this->getMockBuilder(UnaryFunctionTraitTestObject::class)
            ->getMockForAbstractClass()
        ;
        $this->assertSame(1, $unary->arity());
    }
}
