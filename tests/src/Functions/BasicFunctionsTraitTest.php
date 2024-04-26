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
use Tailors\Logic\Validators\BasicValidatorsInterface;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @covers \Tailors\Logic\Functions\BasicFunctionsTrait
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class BasicFunctionsTraitTest extends TestCase
{
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    /**
     * @uses \Tailors\Logic\Functions\Constant::__construct
     * @uses \Tailors\Logic\Functions\AbstractNumericFunction::__construct
     */
    public function testConst(): void
    {
        $functions = $this->getBasicFunctionsObject();
        $this->assertInstanceOf(Constant::class, $functions->const('x'));
    }

    /**
     * @uses \Tailors\Logic\AbstractFunctorExpression::__construct
     * @uses \Tailors\Logic\AbstractFunctorExpression::functor
     * @uses \Tailors\Logic\AbstractFunctorExpression::arguments
     * @uses \Tailors\Logic\Functions\AbstractNumericFunction::__construct
     * @uses \Tailors\Logic\Functions\BinaryFunctionTrait::with
     * @uses \Tailors\Logic\Functions\Constant::__construct
     * @uses \Tailors\Logic\Functions\FunctionTerm::__construct
     * @uses \Tailors\Logic\Functions\FunctionTerm::function
     */
    public function testSub(): void
    {
        $functions = $this->getBasicFunctionsObject();
        $t1 = $this->getMockBuilder(TermInterface::class)
            ->getMock()
        ;
        $t2 = $this->getMockBuilder(TermInterface::class)
            ->getMock()
        ;

        $term = $functions->sub($t1, $t2);
        $this->assertInstanceOf(FunctionTerm::class, $term);
        $this->assertInstanceOf(Sub::class, $term->function());
        $this->assertSame([$t1, $t2], $term->arguments());
    }

    /**
     * @uses \Tailors\Logic\AbstractFunctorExpression::__construct
     * @uses \Tailors\Logic\AbstractFunctorExpression::functor
     * @uses \Tailors\Logic\AbstractFunctorExpression::arguments
     * @uses \Tailors\Logic\Functions\AbstractNumericFunction::__construct
     * @uses \Tailors\Logic\Functions\BinaryFunctionTrait::with
     * @uses \Tailors\Logic\Functions\Constant::__construct
     * @uses \Tailors\Logic\Functions\FunctionTerm::__construct
     * @uses \Tailors\Logic\Functions\FunctionTerm::function
     */
    public function testSum(): void
    {
        $functions = $this->getBasicFunctionsObject();
        $t1 = $this->getMockBuilder(TermInterface::class)
            ->getMock()
        ;
        $t2 = $this->getMockBuilder(TermInterface::class)
            ->getMock()
        ;

        $term = $functions->sum($t1, $t2);
        $this->assertInstanceOf(FunctionTerm::class, $term);
        $this->assertInstanceOf(Sum::class, $term->function());
        $this->assertSame([$t1, $t2], $term->arguments());
    }

    protected function getBasicFunctionsObject(): BasicFunctionsInterface
    {
        $validators = $this->getMockBuilder(BasicValidatorsInterface::class)
            ->getMock()
        ;

        return new /** @psalm-immutable */ class($validators) implements BasicFunctionsInterface {
            use BasicFunctionsTrait;

            public function __construct(BasicValidatorsInterface $validators)
            {
                $this->basicFunctions = $this->makeBasicFunctions($validators);
            }
        };
    }
}
