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
use Tailors\Logic\FunctionalExpressionTrait;
use Tailors\Logic\TermInterface;

/**
 * @psalm-immutable
 */
final class PredicateFormula implements FormulaInterface
{
    /** @template-use FunctionalExpressionTrait<PredicateInterface,TermInterface> */
    use FunctionalExpressionTrait;

    public function __construct(PredicateInterface $functional, TermInterface ...$arguments)
    {
        $this->functional = $functional;
        $this->arguments = $arguments;
    }

    public function predicate(): PredicateInterface
    {
        return $this->functional;
    }
}
