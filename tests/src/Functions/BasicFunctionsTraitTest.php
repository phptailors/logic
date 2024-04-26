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
 *
 * @coversNothing
 */
#[CoversClass(BasicFunctionsTrait::class)]
#[UsesMethod(AbstractFunctorExpression::class, '__construct')]
#[UsesMethod(AbstractFunctorExpression::class, 'arguments')]
#[UsesMethod(AbstractFunctorExpression::class, 'functor')]
#[UsesMethod(AbstractNumericFunction::class, '__construct')]
#[UsesMethod(BinaryFunctionTrait::class, 'with')]
#[UsesMethod(Constant::class, '__construct')]
#[UsesMethod(FunctionTerm::class, '__construct')]
#[UsesMethod(FunctionTerm::class, 'function')]
final class BasicFunctionsTraitTest extends TestCase
{
    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testConst(): void
    {
        $functions = $this->getBasicFunctionsObject();
        $this->assertInstanceOf(Constant::class, $functions->const('x'));
    }

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
