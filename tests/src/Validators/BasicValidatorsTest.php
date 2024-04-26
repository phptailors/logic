<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Validators;

use PHPUnit\Framework\TestCase;
use Tailors\PHPUnit\ImplementsInterfaceTrait;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @covers \Tailors\Logic\Validators\BasicValidators
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class BasicValidatorsTest extends TestCase
{
    use ImplementsInterfaceTrait;

    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testImplementsArglistValidatorInterface(): void
    {
        $this->assertImplementsInterface(BasicValidatorsInterface::class, BasicValidators::class);
    }

    public function testComparatorArglistValidator(): void
    {
        $validators = new BasicValidators();
        $this->assertInstanceOf(ComparatorArglistValidator::class, $validators->comparatorArglist());
    }

    public function testNumbersArglistValidator(): void
    {
        $validators = new BasicValidators();
        $this->assertInstanceOf(NumbersArglistValidator::class, $validators->numbersArglist());
    }
}
