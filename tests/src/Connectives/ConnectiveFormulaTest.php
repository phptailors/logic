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
use Tailors\Logic\FunctorInterface;
use Tailors\Logic\FunctorMockConstructor;
use Tailors\PHPUnit\ImplementsInterfaceTrait;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \Tailors\Logic\Connectives\ConnectiveFormula
 *
 * @uses \Tailors\Logic\AbstractFunctorExpression
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @psalm-import-type FunctorMockParams from FunctorMockConstructor
 *
 * @internal
 */
final class ConnectiveFormulaTest extends TestCase
{
    use ImplementsInterfaceTrait;

    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testImplementsFormulaInterface(): void
    {
        $this->assertImplementsInterface(FormulaInterface::class, ConnectiveFormula::class);
    }

    public function testConnectiveReturnsProvidedConnective(): void
    {
        $p = $this->getMockBuilder(ConnectiveInterface::class)->getMock();

        /** @var ConnectiveInterface $p */
        $term = new ConnectiveFormula($p);
        $this->assertSame($p, $term->connective());
    }

    public function testFunctorReturnsProvidedConnective(): void
    {
        $p = $this->getMockBuilder(ConnectiveInterface::class)->getMock();

        /** @var ConnectiveInterface $p */
        $term = new ConnectiveFormula($p);
        $this->assertSame($p, $term->functor());
    }

    public function testArgumentsReturnsProvidedArguments(): void
    {
        $p = $this->getMockBuilder(ConnectiveInterface::class)->getMock();
        $t1 = $this->getMockBuilder(FormulaInterface::class)->getMock();
        $t2 = $this->getMockBuilder(FormulaInterface::class)->getMock();

        /** @var ConnectiveInterface $p */
        $term = new ConnectiveFormula($p, $t1, $t2);
        $this->assertSame([$t1, $t2], $term->arguments());
    }

    /**
     * @psalm-return array<array-key, array{
     *  0: string,
     *  1: FunctorMockParams,
     *  2: list<string>,
     * }>
     */
    public function providerExpressionStringReturnsString(): array
    {
        return [
            [
                '@',
                ['symbol' => '@', 'notation' => FunctorInterface::NOTATION_PREFIX],
                [],
            ],
            [
                '@ t1',
                ['symbol' => '@', 'notation' => FunctorInterface::NOTATION_PREFIX],
                ['t1'],
            ],
            [
                't1 @ t2',
                ['symbol' => '@', 'notation' => FunctorInterface::NOTATION_INFIX],
                ['t1', 't2'],
            ],
        ];
    }

    /**
     * @dataProvider providerExpressionStringReturnsString
     *
     * @psalm-param FunctorMockParams $functorParams
     * @psalm-param array<string> $arguments
     */
    public function testExpressionStringReturnsString(string $result, array $functorParams, array $arguments): void
    {
        $arguments = array_map(function (string $symbol) {
            $formula = $this->getMockBuilder(FormulaInterface::class)
                ->onlyMethods(['expressionString'])
                ->getMockForAbstractClass()
            ;
            $formula->expects($this->once())
                ->method('expressionString')
                ->willReturn($symbol)
            ;

            return $formula;
        }, $arguments);

        $mockCtor = new FunctorMockConstructor($this, ConnectiveInterface::class, ['apply']);
        $connective = $mockCtor->getMock($functorParams);

        /**
         * @var ConnectiveInterface     $connective
         * @var array<FormulaInterface> $arguments
         */
        $formula = new ConnectiveFormula($connective, ...$arguments);
        $this->assertSame($result, $formula->expressionString());
    }
}
