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
use Tailors\Logic\TermInterface;
use Tailors\Logic\Validators\BasicValidatorsInterface;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \Tailors\Logic\Predicates\BasicPredicatesTrait
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class BasicPredicatesTraitTest extends TestCase
{
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

    /**
     * @uses \Tailors\Logic\AbstractFunctorExpression::__construct
     * @uses \Tailors\Logic\AbstractFunctorExpression::arguments
     * @uses \Tailors\Logic\Predicates\PredicateFormula::__construct
     * @uses \Tailors\Logic\Predicates\UnaryPredicateTrait::with
     */
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
