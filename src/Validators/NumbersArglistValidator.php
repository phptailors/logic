<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Validators;

/**
 * Asserts that all the $arguments are numbers.
 *
 * @psalm-immutable
 * @psalm-type Number = int|float
 * @psalm-type Arglist = list
 * @psalm-type ValidArglist = list<Number>
 * @template-extends AbstractArglistValidator<Arglist,ValidArglist>
 */
final class NumbersArglistValidator extends AbstractArglistValidator implements NumbersArglistValidatorInterface
{
    /**
     * @param mixed $value
     * @psalm-assert-if-true Number $value
     */
    protected function isValid($value, int $index): bool
    {
        return is_int($value) || is_float($value);
    }

    protected function describeInvalidArguments(bool $plural): string
    {
        return $plural ? 'are not numbers' : 'is not a number';
    }
}
