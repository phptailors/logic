<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Connectives;

use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\Attributes\UsesMethod;
use PHPUnit\Framework\TestCase;
use Tailors\Logic\AbstractFunctorExpression;
use Tailors\Logic\FormulaInterface;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
#[CoversTrait(BasicConnectivesTrait::class)]
#[UsesMethod(AbstractFunctorExpression::class, '__construct')]
#[UsesMethod(AbstractFunctorExpression::class, 'arguments')]
#[UsesMethod(AbstractFunctorExpression::class, 'functor')]
#[UsesMethod(BinaryConnectiveTrait::class, 'with')]
#[UsesMethod(ConnectiveFormula::class, '__construct')]
#[UsesMethod(ConnectiveFormula::class, 'connective')]
final class BasicConnectivesTraitTest extends TestCase
{
    #[\Override]
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testAnd(): void
    {
        $connectives = $this->getBasicConnectivesObject();
        $f1 = $this->getMockBuilder(FormulaInterface::class)
            ->getMock()
        ;
        $f2 = $this->getMockBuilder(FormulaInterface::class)
            ->getMock()
        ;
        $formula = $connectives->and($f1, $f2);
        $this->assertInstanceOf(ConnectiveFormula::class, $formula);
        $this->assertInstanceOf(Conjunction::class, $formula->connective());
        $this->assertSame([$f1, $f2], $formula->arguments());
    }

    public function testOr(): void
    {
        $connectives = $this->getBasicConnectivesObject();
        $f1 = $this->getMockBuilder(FormulaInterface::class)
            ->getMock()
        ;
        $f2 = $this->getMockBuilder(FormulaInterface::class)
            ->getMock()
        ;
        $formula = $connectives->or($f1, $f2);
        $this->assertInstanceOf(ConnectiveFormula::class, $formula);
        $this->assertInstanceOf(Disjunction::class, $formula->connective());
        $this->assertSame([$f1, $f2], $formula->arguments());
    }

    protected function getBasicConnectivesObject(): BasicConnectivesInterface
    {
        return new /** @psalm-immutable */ class() implements BasicConnectivesInterface {
            use BasicConnectivesTrait;

            public function __construct()
            {
                $this->basicConnectives = $this->makeBasicConnectives();
            }
        };
    }
}
