<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Validators;

use PHPUnit\Framework\TestCase;
use Tailors\Logic\Exceptions\InvalidArgumentException;
use Tailors\PHPUnit\ExtendsClassTrait;
use Tailors\PHPUnit\ImplementsInterfaceTrait;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \Tailors\Logic\Validators\NumbersArglistValidator
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class NumbersArglistValidatorTest extends TestCase
{
    use ImplementsInterfaceTrait;
    use ExtendsClassTrait;

    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testImplementsNumbersArglistValidatorInterface(): void
    {
        $this->assertImplementsInterface(
            NumbersArglistValidatorInterface::class,
            NumbersArglistValidator::class
        );
    }

    public function testExtendsAbstractArglistValidator(): void
    {
        $this->assertExtendsClass(AbstractArglistValidator::class, NumbersArglistValidator::class);
    }

    /**
     * @uses \Tailors\Logic\Validators\AbstractArglistValidator::validate
     */
    public function testValidateSuccess(): void
    {
        $validator = new NumbersArglistValidator();

        $this->assertNull($validator->validate('foo', [1, 1.2]));
    }

    /**
     * @uses \Tailors\Logic\Validators\AbstractArglistValidator::validate
     * @uses \Tailors\Logic\Validators\AbstractArglistValidator::report
     * @uses \Tailors\Logic\Validators\AbstractArglistValidator::reportSingle
     */
    public function testValidateSingleArgumentFailure(): void
    {
        $validator = new NumbersArglistValidator();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('argument 3 provided to foo is not a number');

        $validator->validate('foo', [1, 1.2, true]);
    }

    /**
     * @uses \Tailors\Logic\Validators\AbstractArglistValidator::validate
     * @uses \Tailors\Logic\Validators\AbstractArglistValidator::report
     * @uses \Tailors\Logic\Validators\AbstractArglistValidator::reportMultiple
     */
    public function testValidateMultipleArgumentsFailure(): void
    {
        $validator = new NumbersArglistValidator();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('arguments 2, 4 and 6 provided to foo are not numbers');

        $validator->validate('foo', [1, 'x', 1.1, 'y', -0.9, new \StdClass()]);
    }
}
