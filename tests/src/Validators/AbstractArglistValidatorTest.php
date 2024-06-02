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

    #[\Override]
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
        $validator = new
            /**
             * @psalm-immutable
             *
             * @template-extends AbstractArglistValidator<list>
             */
            class() extends AbstractArglistValidator {
                protected function isValid($value, int $index): bool
                {
                    return true;
                }
            };

        $this->assertNull($validator->validate('foo', ['x', 'y']));
    }

    public function testValidateSingleArgumentFailure(): void
    {
        $validator = new
            /**
             * @psalm-immutable
             *
             * @template-extends AbstractArglistValidator<list>
             */
            class() extends AbstractArglistValidator {
                protected function isValid($value, int $index): bool
                {
                    return 2 !== $index;
                }
            };

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('argument 3 provided to foo is invalid');

        $validator->validate('foo', ['u', 'v', 'w', 'x', 'y', 'z']);
    }

    public function testValidateMultipleArgumentsFailure(): void
    {
        $validator = new
            /**
             * @psalm-immutable
             *
             * @template-extends AbstractArglistValidator<list>
             */
            class() extends AbstractArglistValidator {
                protected function isValid($value, int $index): bool
                {
                    return 1 !== $index && 3 !== $index && 5 !== $index;
                }
            };

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('arguments 2, 4 and 6 provided to foo are invalid');

        $validator->validate('foo', ['u', 'v', 'w', 'x', 'y', 'z']);
    }
}
