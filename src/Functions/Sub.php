<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

use Tailors\Logic\InfixNotationTrait;

/**
 * @psalm-immutable
 *
 * @psalm-type Number = int|float
 * @psalm-type ValidArglist = list<Number>
 *
 * @template-extends AbstractNumericFunction<2>
 */
final class Sub extends AbstractNumericFunction
{
    use InfixNotationTrait;
    use BinaryFunctionTrait;

    public function symbol(): string
    {
        return '-';
    }

    /**
     * @psalm-return 7
     *
     * @see https://www.php.net/manual/en/language.operators.precedence.php
     */
    public function precedence(): int
    {
        return 7;
    }

    /**
     * @psalm-param ValidArglist $arguments
     *
     * @psalm-return Number
     */
    protected function applyImpl(array $arguments): float|int
    {
        if (0 === count($arguments)) {
            return 0;
        }
        $arg1 = array_shift($arguments);

        return array_reduce($arguments, fn (float|int $result, float|int $arg) => $result - $arg, $arg1);
    }
}
