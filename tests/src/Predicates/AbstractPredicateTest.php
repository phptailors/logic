<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Predicates;

use PHPUnit\Framework\TestCase;
use Tailors\PHPUnit\ImplementsInterfaceTrait;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \Tailors\Logic\Predicates\AbstractPredicate
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class AbstractPredicateTest extends TestCase
{
    use ImplementsInterfaceTrait;

    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    /**
     * @psalm-return \PHPUnit\Framework\MockObject\MockObject&AbstractPredicate<0|positive-int,list<mixed>>
     */
    public function getAbstractPredicateMock()
    {
        $func = $this->getMockBuilder(AbstractPredicate::class)
            ->onlyMethods([
                'applyImpl',
                'arity',
                'notation',
                'symbol',
                'validate',
            ])->getMock();

        $func->expects($this->never())
            ->method('arity')
        ;

        $func->expects($this->never())
            ->method('notation')
        ;

        $func->expects($this->never())
            ->method('symbol')
        ;

        return $func;
    }

    public function testImplementsPredicateInterface(): void
    {
        $this->assertImplementsInterface(PredicateInterface::class, AbstractPredicate::class);
    }

    public function testApplyCallsValidateAndApplyImpl(): void
    {
        $func = $this->getAbstractPredicateMock();

        $func->expects($this->once())
            ->method('applyImpl')
            ->with([0 => 'X', 1 => 'Y', 2 => 'Z'])
            ->willReturn(true)
        ;

        $func->expects($this->once())
            ->method('validate')
            ->with([0 => 'X', 1 => 'Y', 2 => 'Z'])
        ;

        $arguments = [0 => 'X', 5 => 'Y', 8 => 'Z'];
        $this->assertTrue($func->apply(...$arguments));
    }
}
