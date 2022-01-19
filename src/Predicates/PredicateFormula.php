<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Predicates;

use Tailors\Logic\AbstractFunctorExpression;
use Tailors\Logic\FormulaInterface;
use Tailors\Logic\TermInterface;

/**
 * @psalm-immutable
 * @template-extends AbstractFunctorExpression<PredicateInterface,TermInterface>
 */
final class PredicateFormula extends AbstractFunctorExpression implements FormulaInterface
{
    public function __construct(PredicateInterface $predicate, TermInterface ...$arguments)
    {
        parent::__construct($predicate, $arguments);
    }

    public function predicate(): PredicateInterface
    {
        return $this->functor();
    }
}
