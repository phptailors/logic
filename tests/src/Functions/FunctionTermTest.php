<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Tailors\Logic\AbstractFunctorExpression;
use Tailors\Logic\FunctorInterface;
use Tailors\Logic\GetFunctorMockTrait;
use Tailors\Logic\TermInterface;
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
#[CoversClass(FunctionTerm::class)]
#[UsesClass(AbstractFunctorExpression::class)]
final class FunctionTermTest extends TestCase
{
    use ImplementsInterfaceTrait;
    use GetFunctorMockTrait;

    #[\Override]
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testImplementsTermInterface(): void
    {
        $this->assertImplementsInterface(TermInterface::class, FunctionTerm::class);
    }

    public function testFunctionReturnsProvidedFunction(): void
    {
        $f = $this->getMockBuilder(FunctionInterface::class)->getMock();

        /** @var FunctionInterface $f */
        $term = new FunctionTerm($f);
        $this->assertSame($f, $term->function());
    }

    public function testFunctorReturnsProvidedFunction(): void
    {
        $f = $this->getMockBuilder(FunctionInterface::class)->getMock();

        /** @var FunctionInterface $f */
        $term = new FunctionTerm($f);
        $this->assertSame($f, $term->functor());
    }

    public function testArgumentsReturnsProvidedArguments(): void
    {
        $f = $this->getMockBuilder(FunctionInterface::class)->getMock();
        $t1 = $this->getMockBuilder(TermInterface::class)->getMock();
        $t2 = $this->getMockBuilder(TermInterface::class)->getMock();

        /** @var FunctionInterface $f */
        $term = new FunctionTerm($f, $t1, $t2);
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
                '@()',
                ['symbol' => '@', 'notation' => FunctorInterface::NOTATION_FUNCTION],
                [],
            ],
            [
                '@(t1)',
                ['symbol' => '@', 'notation' => FunctorInterface::NOTATION_FUNCTION],
                ['t1'],
            ],
            [
                '@(t1, t2)',
                ['symbol' => '@', 'notation' => FunctorInterface::NOTATION_FUNCTION],
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
            $term = $this->createMock(TermInterface::class);
            $term->expects($this->once())
                ->method('expressionString')
                ->willReturn($symbol)
            ;

            return $term;
        }, $arguments);

        $function = $this->getFunctorMock($functorParams, FunctionInterface::class, ['apply' => true]);

        /**
         * @var FunctionInterface    $function
         * @var array<TermInterface> $arguments
         */
        $term = new FunctionTerm($function, ...$arguments);
        $this->assertSame($result, $term->expressionString());
    }

    /**
     * @psalm-return array<array-key, array{
     *  0: mixed,
     *  1: FunctorMockParams,
     *  2: list,
     *  3: array<string,mixed>
     * }>
     */
    public static function providerEvaluateReturnsValue(): array
    {
        return [
            'FunctionTermTest.php:'.__LINE__ => [
                'ok',
                [],
                [],
                [],
            ],
            'FunctionTermTest.php:'.__LINE__ => [
                'ok',
                [],
                ['x', 'y', 'z'],
                ['x' => 123],
            ],
        ];
    }

    /**
     * @psalm-param FunctorMockParams $functorParams
     * @psalm-param list $arguments
     * @psalm-param array<string, mixed> $environment
     */
    #[DataProvider('providerEvaluateReturnsValue')]
    public function testEvaluateReturnsValue(
        mixed $result,
        array $functorParams,
        array $arguments,
        array $environment
    ): void {
        $terms = array_map(
            /**
             * @param mixed $argument
             *
             * @psalm-return MockObject&TermInterface
             */
            function (mixed $argument) use ($environment): MockObject {
                $term = $this->createMock(TermInterface::class);
                $term->expects($this->once())
                    ->method('evaluate')
                    ->with($environment)
                    ->willReturn($argument)
                ;

                return $term;
            },
            $arguments
        );

        $function = $this->getFunctorMock($functorParams, FunctionInterface::class, ['apply' => false]);

        $function->expects($this->once())
            ->method('apply')
            ->with(...$arguments)
            ->willReturn($result)
        ;

        /**
         * @var FunctionInterface    $function
         * @var array<TermInterface> $arguments
         */
        $formula = new FunctionTerm($function, ...$terms);
        $this->assertSame($result, $formula->evaluate($environment));
    }
}
