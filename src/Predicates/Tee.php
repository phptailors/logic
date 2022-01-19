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
use Tailors\Logic\SymbolNotationTrait;

/**
 * @psalm-immutable
 */
final class Tee implements PredicateInterface, FormulaInterface
{
    use SymbolNotationTrait;

    /**
     * @param mixed $arguments
     */
    public function apply(...$arguments): bool
    {
        return true;
    }

    /**
     * @psalm-return 0
     */
    public function arity(): int
    {
        return 0;
    }

    public function symbol(): string
    {
        return '⊤';
    }

    public function expressionString(FunctorExpressionInterface $parent = null): string
    {
        return $this->symbol();
    }
}
