<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Predicates;

use PHPUnit\Framework\Attributes\CoversClass;
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
#[CoversClass(BasicPredicatesTrait::class)]
#[UsesMethod(AbstractFunctorExpression::class, '__construct')]
#[UsesMethod(AbstractFunctorExpression::class, 'arguments')]
#[UsesMethod(PredicateFormula::class, '__construct')]
#[UsesMethod(UnaryPredicateTrait::class, 'with')]
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
