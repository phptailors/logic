<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Predicates;

use Tailors\Logic\InfixNotationTrait;

/**
 * @psalm-immutable
 *
 * @psalm-type ValidArglist = list
 *
 * @template-extends AbstractPredicate<2,ValidArglist>
 */
final class LessEqual extends AbstractPredicate
{
    use InfixNotationTrait;
    use BinaryPredicateTrait;

    public function symbol(): string
    {
        return '<=';
    }

    /**
     * @psalm-return 11
     *
     * @see https://www.php.net/manual/en/language.operators.precedence.php
     */
    public function precedence(): int
    {
        return 11;
    }

    /**
     * @psalm-param ValidArglist $arguments
     */
    protected function applyImpl(array $arguments): bool
    {
        return count($arguments) >= 2 && $arguments[0] <= $arguments[1];
    }

    /**
     * @param list $arguments
     */
    protected function validate(array $arguments): void {}
}
