<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tailors\Logic\Connectives\BasicConnectivesTrait;
use Tailors\Logic\Functions\BasicFunctionsTrait;
use Tailors\Logic\Predicates\BasicPredicatesTrait;
use Tailors\PHPUnit\ImplementsInterfaceTrait;
use Tailors\PHPUnit\UsesTraitTrait;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 *
 * @coversNothing
 */
#[CoversClass(Logic::class)]
final class LogicTest extends TestCase
{
    use ImplementsInterfaceTrait;
    use UsesTraitTrait;

    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testImplementsLogicInterface(): void
    {
        $this->assertImplementsInterface(LogicInterface::class, Logic::class);
    }

    public function testUsesBasicFunctionsTrait(): void
    {
        $this->assertUsesTrait(BasicFunctionsTrait::class, Logic::class);
    }

    public function testUsesBasicPredicatesTrait(): void
    {
        $this->assertUsesTrait(BasicPredicatesTrait::class, Logic::class);
    }

    public function testUsesBasicConnectivesTrait(): void
    {
        $this->assertUsesTrait(BasicConnectivesTrait::class, Logic::class);
    }

    /**
     * @uses \Tailors\Logic\Functions\AbstractNumericFunction::__construct
     * @uses \Tailors\Logic\Validators\BasicValidators::__construct
     * @uses \Tailors\Logic\Validators\BasicValidators::numbersArglist
     * @uses \Tailors\Logic\Variable::__construct
     * @uses \Tailors\Logic\Variable::symbol
     */
    public function testVar(): void
    {
        $logic = new Logic();
        $x = $logic->var('x');
        $this->assertInstanceOf(Variable::class, $x);
        $this->assertSame('x', $x->symbol());
    }
}
