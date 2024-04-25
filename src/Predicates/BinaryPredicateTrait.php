<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Predicates;

use Tailors\Logic\TermInterface;

/**
 * @psalm-immutable
 */
trait BinaryPredicateTrait
{
    public function with(TermInterface $t1, TermInterface $t2, TermInterface ...$t): PredicateFormula
    {
        return new PredicateFormula($this, $t1, $t2, ...$t);
    }

    /**
     * @psalm-return 2
     */
    public function arity(): int
    {
        return 2;
    }
}
