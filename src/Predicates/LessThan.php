<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Predicates;

/**
 * @psalm-immutable
 *
 * @psalm-type ValidArglist = list
 */
final class LessThan extends AbstractComparisonPredicate
{
    public function symbol(): string
    {
        return '<';
    }

    protected function compareImpl(mixed $a1, mixed $a2): bool
    {
        return $a1 < $a2;
    }
}
