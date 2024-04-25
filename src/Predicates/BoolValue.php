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
use Tailors\Logic\FunctionNotationTrait;

/**
 * @psalm-immutable
 *
 * @psalm-type Arglist = list
 * @psalm-type ValidArglist = non-empty-list
 *
 * @template-extends AbstractPredicate<1,ValidArglist>
 */
final class BoolValue extends AbstractPredicate
{
    use FunctionNotationTrait;
    use UnaryPredicateTrait;

    public function symbol(): string
    {
        return 'bool';
    }

    /**
     * @psalm-param ValidArglist $arguments
     */
    protected function applyImpl(array $arguments): bool
    {
        return (bool) reset($arguments);
    }

    /**
     * @psalm-param Arglist $arguments
     * @psalm-assert ValidArglist $arguments
     *
     * @throws \Tailors\Logic\Exceptions\InvalidArgumentException
     */
    protected function validate(array $arguments): void
    {
        if (0 === count($arguments)) {
            throw new InvalidArgumentException('missing argument');
        }
    }
}
