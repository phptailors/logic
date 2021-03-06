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
use Tailors\PHPUnit\ImplementsInterfaceTrait;

/**
 * @author Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 * @covers \Tailors\Logic\Validators\AbstractArglistValidator
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
final class AbstractArglistValidatorTest extends TestCase
{
    use ImplementsInterfaceTrait;

    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testImplementsArglistValidatorInterface(): void
    {
        $this->assertImplementsInterface(ArglistValidatorInterface::class, AbstractArglistValidator::class);
    }

    public function testValidateSuccess(): void
    {
        $validator = $this->getMockBuilder(AbstractArglistValidator::class)
            ->onlyMethods(['isValid'])
            ->getMock()
        ;

        $validator->expects($this->exactly(2))
            ->method('isValid')
            ->withConsecutive(['x', 0], ['y', 1])
            ->willReturn(true)
        ;

        $this->assertNull($validator->validate('foo', ['x', 'y']));
    }

    public function testValidateSingleArgumentFailure(): void
    {
        $validator = $this->getMockBuilder(AbstractArglistValidator::class)
            ->onlyMethods(['isValid'])
            ->getMock()
        ;

        $validator->expects($this->exactly(6))
            ->method('isValid')
            ->withConsecutive(['u', 0], ['v', 1], ['w', 2], ['x', 3], ['y', 4], ['z', 5])
            ->willReturnOnConsecutiveCalls(true, true, false, true, true, true)
        ;

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('argument 3 provided to foo is invalid');

        $validator->validate('foo', ['u', 'v', 'w', 'x', 'y', 'z']);
    }

    public function testValidateMultipleArgumentsFailure(): void
    {
        $validator = $this->getMockBuilder(AbstractArglistValidator::class)
            ->onlyMethods(['isValid'])
            ->getMock()
        ;

        $validator->expects($this->exactly(6))
            ->method('isValid')
            ->withConsecutive(['u', 0], ['v', 1], ['w', 2], ['x', 3], ['y', 4], ['z', 5])
            ->willReturnOnConsecutiveCalls(true, false, true, false, true, false)
        ;

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('arguments 2, 4 and 6 provided to foo are invalid');

        $validator->validate('foo', ['u', 'v', 'w', 'x', 'y', 'z']);
    }
}
