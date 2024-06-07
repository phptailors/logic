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
abstract class AbstractComparisonPredicate extends AbstractPredicate
{
    use InfixNotationTrait;
    use BinaryPredicateTrait;

    /**
     * @psalm-return 11
     *
     * @see https://www.php.net/manual/en/language.operators.precedence.php
     */
    #[\Override]
    final public function precedence(): int
    {
        return 11;
    }

    /**
     * @psalm-param ValidArglist $arguments
     */
    #[\Override]
    final protected function applyImpl(array $arguments): bool
    {
        return count($arguments) >= 2 && $this->cmpImpl(...$arguments);
    }

    abstract protected function cmpImpl(mixed $a1, mixed $a2): bool;

    /**
     * @param list $arguments
     */
    #[\Override]
    final protected function validate(array $arguments): void {}
}
