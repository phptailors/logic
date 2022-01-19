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
 * @covers \Tailors\Logic\Connectives\BasicConnectivesTrait
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class BasicConnectivesTraitTest extends TestCase
{
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    /**
     * @uses \Tailors\Logic\Connectives\BinaryConnectiveTrait::with
     * @uses \Tailors\Logic\Connectives\ConnectiveFormula::__construct
     * @uses \Tailors\Logic\Connectives\ConnectiveFormula::connective
     * @uses \Tailors\Logic\FunctorExpressionTrait::arguments
     */
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

    /**
     * @uses \Tailors\Logic\Connectives\BinaryConnectiveTrait::with
     * @uses \Tailors\Logic\Connectives\ConnectiveFormula::__construct
     * @uses \Tailors\Logic\Connectives\ConnectiveFormula::connective
     * @uses \Tailors\Logic\FunctorExpressionTrait::arguments
     */
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
