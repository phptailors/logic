<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Connectives;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\UsesMethod;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tailors\Logic\AbstractFunctorExpression;
use Tailors\Logic\FormulaInterface;
use Tailors\Logic\FunctorInterface;
use Tailors\Logic\GetFunctorMockTrait;
use Tailors\Logic\QuantifiedFormula;
use Tailors\PHPUnit\ImplementsInterfaceTrait;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @psalm-import-type FunctorMockParams from GetFunctorMockTrait
 *
 * @internal
 */
#[CoversClass(ConnectiveFormula::class)]
#[UsesClass(AbstractFunctorExpression::class)]
#[UsesMethod(QuantifiedFormula::class, '__construct')]
#[UsesMethod(QuantifiedFormula::class, 'environment')]
final class ConnectiveFormulaTest extends TestCase
{
    use ImplementsInterfaceTrait;
    use GetFunctorMockTrait;

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
    public static function providerExpressionStringReturnsString(): array
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
     * @psalm-param FunctorMockParams $functorParams
     * @psalm-param array<string> $arguments
     */
    #[DataProvider('providerExpressionStringReturnsString')]
    public function testExpressionStringReturnsString(string $result, array $functorParams, array $arguments): void
    {
        $arguments = array_map(function (string $symbol) {
            $formula = $this->createMock(FormulaInterface::class);
            $formula->expects($this->once())
                ->method('expressionString')
                ->willReturn($symbol)
            ;

            return $formula;
        }, $arguments);

        $connective = $this->getFunctorMock($functorParams, ConnectiveInterface::class, ['apply' => true]);

        /**
         * @var ConnectiveInterface     $connective
         * @var array<FormulaInterface> $arguments
         */
        $formula = new ConnectiveFormula($connective, ...$arguments);
        $this->assertSame($result, $formula->expressionString());
    }

    /**
     * @psalm-return array<array-key, array{
     *  0: bool,
     *  1: FunctorMockParams,
     *  2: list<bool>,
     *  3: array<string,mixed>
     * }>
     */
    public static function providerEvaluateReturnsBool(): array
    {
        return [
            [
                false,
                [],
                [],
                [],
            ],
            [
                true,
                [],
                [],
                [],
            ],
            [
                false,
                [],
                [true, false, true],
                ['x' => 123],
            ],
        ];
    }

    /**
     * @psalm-param FunctorMockParams $functorParams
     * @psalm-param list<bool> $arguments
     * @psalm-param array<string, mixed> $environment
     */
    #[DataProvider('providerEvaluateReturnsBool')]
    public function testEvaluateReturnsBool(
        bool $result,
        array $functorParams,
        array $arguments,
        array $environment
    ): void {
        $terms = array_map(
            /**
             * @param mixed $argument
             *
             * @psalm-return MockObject&FormulaInterface
             */
            function ($argument) use ($environment): MockObject {
                $term = $this->createMock(FormulaInterface::class);
                $term->expects($this->once())
                    ->method('evaluate')
                    ->with($environment)
                    ->willReturn($argument)
                ;

                return $term;
            },
            $arguments
        );

        $connective = $this->getFunctorMock($functorParams, ConnectiveInterface::class, ['apply' => false]);

        $connective->expects($this->once())
            ->method('apply')
            ->with(...$arguments)
            ->willReturn($result)
        ;

        /**
         * @var ConnectiveInterface     $connective
         * @var array<FormulaInterface> $arguments
         */
        $formula = new ConnectiveFormula($connective, ...$terms);
        $this->assertSame($result, $formula->evaluate($environment));
    }

    public function testWhereReturnsQuantifiedFormula(): void
    {
        $terms = [$this->getMockBuilder(FormulaInterface::class)->getMock()];
        $connective = $this->getMockBuilder(ConnectiveInterface::class)->getMock();
        $formula = new ConnectiveFormula($connective, ...$terms);
        $quantified = $formula->where(['x' => 123]);
        $this->assertInstanceOf(QuantifiedFormula::class, $quantified);
        $this->assertSame(['x' => 123], $quantified->environment());
    }
}
