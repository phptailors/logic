<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
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
final class Falsum implements PredicateInterface, FormulaInterface
{
    use SymbolNotationTrait;

    /**
     * @param mixed $arguments
     */
    #[\Override]
    public function apply(...$arguments): bool
    {
        return false;
    }

    /**
     * @psalm-return 0
     */
    #[\Override]
    public function arity(): int
    {
        return 0;
    }

    #[\Override]
    public function symbol(): string
    {
        return '⊥';
    }

    #[\Override]
    public function expressionString(?FunctorExpressionInterface $parent = null): string
    {
        return $this->symbol();
    }

    /**
     * @psalm-return 0
     *
     * @see https://www.php.net/manual/en/language.operators.precedence.php
     */
    #[\Override]
    public function precedence(): int
    {
        return 0;
    }

    /**
     * @psalm-param array<string,mixed> $environment
     */
    #[\Override]
    public function evaluate(array $environment = []): bool
    {
        return $this->apply();
    }

    /**
     * @psalm-param array<string,mixed> $environment
     */
    #[\Override]
    public function where(array $environment): self
    {
        return $this;
    }
}
