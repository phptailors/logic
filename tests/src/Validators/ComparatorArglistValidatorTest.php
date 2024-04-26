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
use PHPUnit\Framework\Attributes\UsesMethod;
use PHPUnit\Framework\TestCase;
use Tailors\Logic\Exceptions\InvalidArgumentException;
use Tailors\PHPUnit\ExtendsClassTrait;
use Tailors\PHPUnit\ImplementsInterfaceTrait;

/**
 * @author Paweł Tomulik <pawel@tomulik.pl>
 *
 * @psalm-suppress MissingThrowsDocblock
 *
 * @internal
 */
#[CoversClass(ComparatorArglistValidator::class)]
#[UsesMethod(AbstractArglistValidator::class, 'report')]
#[UsesMethod(AbstractArglistValidator::class, 'reportMultiple')]
#[UsesMethod(AbstractArglistValidator::class, 'reportSingle')]
#[UsesMethod(AbstractArglistValidator::class, 'validate')]
final class ComparatorArglistValidatorTest extends TestCase
{
    use ImplementsInterfaceTrait;
    use ExtendsClassTrait;

    public function setUp(): void
    {
        // Without setUp() we get MissingConstructor error from psalm
    }

    public function testImplementsComparatorArglistValidatorInterface(): void
    {
        $this->assertImplementsInterface(
            ComparatorArglistValidatorInterface::class,
            ComparatorArglistValidator::class
        );
    }

    public function testExtendsAbstractArglistValidator(): void
    {
        $this->assertExtendsClass(AbstractArglistValidator::class, ComparatorArglistValidator::class);
    }

    public function testValidateSuccess(): void
    {
        $validator = new ComparatorArglistValidator();

        $this->assertNull($validator->validate('foo', [1, 1.2, true]));
    }

    public function testValidateSingleArgumentFailure(): void
    {
        $validator = new ComparatorArglistValidator();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('argument 3 provided to foo is not a comparable value');

        $validator->validate('foo', [1, 1.2, 'x', true]);
    }

    public function testValidateMultipleArgumentsFailure(): void
    {
        $validator = new ComparatorArglistValidator();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('arguments 2, 4 and 6 provided to foo are not comparable values');

        $validator->validate('foo', [1, 'x', 1.1, 'y', false, new \stdClass()]);
    }
}
