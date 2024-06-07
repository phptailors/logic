<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Predicates;

use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\UsesMethod;
use PHPUnit\Framework\TestCase;
use Tailors\Logic\AbstractFunctorExpression;
use Tailors\Logic\TermInterface;
use Tailors\Logic\Validators\BasicValidatorsInterface;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
#[CoversTrait(BasicPredicatesTrait::class)]
#[UsesMethod(AbstractFunctorExpression::class, '__construct')]
#[UsesMethod(AbstractFunctorExpression::class, 'arguments')]
#[UsesMethod(PredicateFormula::class, '__construct')]
#[UsesMethod(UnaryPredicateTrait::class, 'with')]
#[UsesMethod(BinaryPredicateTrait::class, 'with')]
final class BasicPredicatesTraitTest extends TestCase
{
    #[\Override]
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testFalsum(): void
    {
        $predicates = $this->getBasicPredicatesObject();
        $this->assertInstanceOf(Falsum::class, $predicates->falsum());
    }

    public function testTee(): void
    {
        $predicates = $this->getBasicPredicatesObject();
        $this->assertInstanceOf(Tee::class, $predicates->tee());
    }

    public function testBool(): void
    {
        $t1 = $this->getMockBuilder(TermInterface::class)
            ->getMock()
        ;
        $predicates = $this->getBasicPredicatesObject();
        $formula = $predicates->bool($t1);
        $this->assertInstanceOf(PredicateFormula::class, $formula);
        $this->assertSame([$t1], $formula->arguments());
    }

    public function testEq(): void
    {
        $t1 = $this->getMockBuilder(TermInterface::class)->getMock();
        $t2 = $this->getMockBuilder(TermInterface::class)->getMock();
        $predicates = $this->getBasicPredicatesObject();
        $formula = $predicates->eq($t1, $t2);
        $this->assertInstanceOf(PredicateFormula::class, $formula);
        $this->assertSame([$t1, $t2], $formula->arguments());
    }

    public function testNeq(): void
    {
        $t1 = $this->getMockBuilder(TermInterface::class)->getMock();
        $t2 = $this->getMockBuilder(TermInterface::class)->getMock();
        $predicates = $this->getBasicPredicatesObject();
        $formula = $predicates->neq($t1, $t2);
        $this->assertInstanceOf(PredicateFormula::class, $formula);
        $this->assertSame([$t1, $t2], $formula->arguments());
    }

    public function testEqq(): void
    {
        $t1 = $this->getMockBuilder(TermInterface::class)->getMock();
        $t2 = $this->getMockBuilder(TermInterface::class)->getMock();
        $predicates = $this->getBasicPredicatesObject();
        $formula = $predicates->eqq($t1, $t2);
        $this->assertInstanceOf(PredicateFormula::class, $formula);
        $this->assertSame([$t1, $t2], $formula->arguments());
    }

    public function testNeqq(): void
    {
        $t1 = $this->getMockBuilder(TermInterface::class)->getMock();
        $t2 = $this->getMockBuilder(TermInterface::class)->getMock();
        $predicates = $this->getBasicPredicatesObject();
        $formula = $predicates->neqq($t1, $t2);
        $this->assertInstanceOf(PredicateFormula::class, $formula);
        $this->assertSame([$t1, $t2], $formula->arguments());
    }

    public function testGt(): void
    {
        $t1 = $this->getMockBuilder(TermInterface::class)->getMock();
        $t2 = $this->getMockBuilder(TermInterface::class)->getMock();
        $predicates = $this->getBasicPredicatesObject();
        $formula = $predicates->gt($t1, $t2);
        $this->assertInstanceOf(PredicateFormula::class, $formula);
        $this->assertSame([$t1, $t2], $formula->arguments());
    }

    public function testLt(): void
    {
        $t1 = $this->getMockBuilder(TermInterface::class)->getMock();
        $t2 = $this->getMockBuilder(TermInterface::class)->getMock();
        $predicates = $this->getBasicPredicatesObject();
        $formula = $predicates->lt($t1, $t2);
        $this->assertInstanceOf(PredicateFormula::class, $formula);
        $this->assertSame([$t1, $t2], $formula->arguments());
    }

    public function testGe(): void
    {
        $t1 = $this->getMockBuilder(TermInterface::class)->getMock();
        $t2 = $this->getMockBuilder(TermInterface::class)->getMock();
        $predicates = $this->getBasicPredicatesObject();
        $formula = $predicates->ge($t1, $t2);
        $this->assertInstanceOf(PredicateFormula::class, $formula);
        $this->assertSame([$t1, $t2], $formula->arguments());
    }

    public function testLe(): void
    {
        $t1 = $this->getMockBuilder(TermInterface::class)->getMock();
        $t2 = $this->getMockBuilder(TermInterface::class)->getMock();
        $predicates = $this->getBasicPredicatesObject();
        $formula = $predicates->le($t1, $t2);
        $this->assertInstanceOf(PredicateFormula::class, $formula);
        $this->assertSame([$t1, $t2], $formula->arguments());
    }

    protected function getBasicPredicatesObject(): BasicPredicatesInterface
    {
        $validators = $this->getMockBuilder(BasicValidatorsInterface::class)
            ->getMock()
        ;

        return new /** @psalm-immutable */ class($validators) implements BasicPredicatesInterface {
            use BasicPredicatesTrait;

            public function __construct(BasicValidatorsInterface $validators)
            {
                $this->basicPredicates = $this->makeBasicPredicates($validators);
            }
        };
    }
}
