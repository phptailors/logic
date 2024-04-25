<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

use PHPUnit\Framework\TestCase;
use Tailors\Logic\TermInterface;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 * @covers \Tailors\Logic\Functions\BinaryFunctionTrait
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class BinaryFunctionTraitTest extends TestCase
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
        $t2 = $this->getMockBuilder(TermInterface::class)
            ->getMock()
        ;
        /** @var \PHPUnit\Framework\MockObject\MockObject & BinaryFunctionTraitTestObject */
        $binary = $this->getMockBuilder(BinaryFunctionTraitTestObject::class)
            ->getMockForAbstractClass()
        ;
        $term = $binary->with($t1, $t2);
        $this->assertInstanceOf(FunctionTerm::class, $term);
        $this->assertSame($binary, $term->function());
        $this->assertSame([$t1, $t2], $term->arguments());
    }

    public function testArity(): void
    {
        /** @var \PHPUnit\Framework\MockObject\MockObject & BinaryFunctionTraitTestObject */
        $binary = $this->getMockBuilder(BinaryFunctionTraitTestObject::class)
            ->getMockForAbstractClass()
        ;
        $this->assertSame(2, $binary->arity());
    }
}
