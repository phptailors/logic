<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Validators;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tailors\Logic\Exceptions\InvalidArgumentException;
use Tailors\PHPUnit\ImplementsInterfaceTrait;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
#[CoversClass(AbstractArglistValidator::class)]
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
        $matcher = $this->exactly(2);

        $validator->expects($matcher)
            ->method('isValid')->willReturnCallback(function () use ($matcher) {
            return match ($matcher->numberOfInvocations()) {
                1 => ['x', 0],
                2 => ['y', 1],
            };
        })
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
        $matcher = $this->exactly(6);

        $validator->expects($matcher)
            ->method('isValid')->willReturnCallback(function () use ($matcher) {
            return match ($matcher->numberOfInvocations()) {
                1 => ['u', 0],
                2 => ['v', 1],
                3 => ['w', 2],
                4 => ['x', 3],
                5 => ['y', 4],
                6 => ['z', 5],
            };
        })
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
        $matcher = $this->exactly(6);

        $validator->expects($matcher)
            ->method('isValid')->willReturnCallback(function () use ($matcher) {
            return match ($matcher->numberOfInvocations()) {
                1 => ['u', 0],
                2 => ['v', 1],
                3 => ['w', 2],
                4 => ['x', 3],
                5 => ['y', 4],
                6 => ['z', 5],
            };
        })
            ->willReturnOnConsecutiveCalls(true, false, true, false, true, false)
        ;

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('arguments 2, 4 and 6 provided to foo are invalid');

        $validator->validate('foo', ['u', 'v', 'w', 'x', 'y', 'z']);
    }
}
