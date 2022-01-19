<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Predicates;

use Tailors\Logic\FormulaInterface;
use Tailors\Logic\FunctorExpressionInterface;
use Tailors\Logic\FunctorExpressionTrait;
use Tailors\Logic\TermInterface;

/**
 * @psalm-immutable
 * @template-implements FunctorExpressionInterface<TermInterface>
 */
final class PredicateFormula implements FormulaInterface, FunctorExpressionInterface
{
    /** @template-use FunctorExpressionTrait<PredicateInterface,TermInterface> */
    use FunctorExpressionTrait;

    public function __construct(PredicateInterface $predicate, TermInterface ...$arguments)
    {
        $this->functor = $predicate;
        $this->arguments = $arguments;
    }

    public function predicate(): PredicateInterface
    {
        return $this->functor;
    }
}
