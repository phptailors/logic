<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Predicates;

use Tailors\Logic\Exceptions\InvalidArgumentException;

/**
 * @psalm-immutable
 *
 * @psalm-template Arity of 0|positive-int
 * @psalm-template ValidArglist of list
 */
abstract class AbstractPredicate implements PredicateInterface
{
    /**
     * @param mixed $arguments
     *
     * @throws InvalidArgumentException
     */
    #[\Override]
    final public function apply(...$arguments): bool
    {
        $argumentsList = array_values($arguments);
        $this->validate($argumentsList);

        return $this->applyImpl($argumentsList);
    }

    /**
     * @psalm-param ValidArglist $arguments
     */
    abstract protected function applyImpl(array $arguments): bool;

    /**
     * @psalm-param list $arguments
     *
     * @psalm-assert ValidArglist $arguments
     *
     * @throws InvalidArgumentException
     */
    abstract protected function validate(array $arguments): void;
}
