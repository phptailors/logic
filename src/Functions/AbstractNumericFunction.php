<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

use Tailors\Logic\Exceptions\InvalidArgumentException;
use Tailors\Logic\Validators\NumbersArglistValidatorInterface;

/**
 * @psalm-immutable
 *
 * @psalm-template Arity of 0|positive-int
 *
 * @psalm-type Number = int|float
 * @psalm-type ValidArglist = list<Number>
 *
 * @template-extends AbstractFunction<Arity,Number,ValidArglist>
 */
abstract class AbstractNumericFunction extends AbstractFunction
{
    public function __construct(private readonly NumbersArglistValidatorInterface $numbersArglistValidator)
    {
    }

    /**
     * @psalm-param list $arguments
     *
     * @psalm-assert ValidArglist $arguments
     *
     * @throws InvalidArgumentException
     */
    #[\Override]
    protected function validate(array $arguments): void
    {
        $this->numbersArglistValidator->validate($this->symbol(), $arguments);
    }
}
