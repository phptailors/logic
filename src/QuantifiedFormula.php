<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic;

use Tailors\Logic\Exceptions\InvalidArgumentException;
use Tailors\Logic\Exceptions\UndefinedVariableException;

/**
 * @psalm-immutable
 */
final readonly class QuantifiedFormula implements FormulaInterface
{
    /**
     * @psalm-param array<string,mixed> $environment
     */
    public function __construct(private FormulaInterface $formula, private array $environment)
    {
    }

    public function formula(): FormulaInterface
    {
        return $this->formula;
    }

    /**
     * @psalm-return array<string,mixed>
     */
    public function environment(): array
    {
        return $this->environment;
    }

    /**
     * @psalm-template Argument of ExpressionInterface
     *
     * @psalm-param FunctorExpressionInterface<Argument> $parent
     */
    #[\Override]
    public function expressionString(?FunctorExpressionInterface $parent = null): string
    {
        return $this->formula()->expressionString($parent);
    }

    /**
     * @psalm-param array<string,mixed> $environment
     *
     * @throws InvalidArgumentException
     * @throws UndefinedVariableException
     */
    #[\Override]
    public function evaluate(array $environment = []): bool
    {
        return $this->formula()->evaluate(array_merge($environment, $this->environment()));
    }

    /**
     * @psalm-param array<string,mixed> $environment
     */
    #[\Override]
    public function where(array $environment): self
    {
        return new self($this, $environment);
    }
}
