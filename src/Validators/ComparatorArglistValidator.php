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
 *
 * @psalm-type Comparable = int|float|bool
 * @psalm-type Arglist = list
 * @psalm-type ValidArglist = list<Comparable>
 *
 * @template-extends AbstractArglistValidator<Arglist,ValidArglist>
 */
final class ComparatorArglistValidator extends AbstractArglistValidator implements ComparatorArglistValidatorInterface
{
    /**
     * @param mixed $value
     *
     * @psalm-assert-if-true Comparable $value
     */
    protected function isValid($value, int $index): bool
    {
        return is_int($value) || is_float($value) || is_bool($value);
    }

    protected function describeInvalidArguments(bool $plural): string
    {
        return $plural ? 'are not comparable values' : 'is not a comparable value';
    }
}
