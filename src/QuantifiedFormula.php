<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic;

/**
 * @psalm-immutable
 */
final class QuantifiedFormula implements FormulaInterface
{
    /**
     * @var FormulaInterface
     */
    private $formula;

    /**
     * @var array<string,mixed>
     */
    private $environment;

    /**
     * @psalm-param array<string,mixed> $environment
     */
    public function __construct(FormulaInterface $formula, array $environment)
    {
        $this->formula = $formula;
        $this->environment = $environment;
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
     * @psalm-param FunctorExpressionInterface<Argument> $parent
     */
    public function expressionString(FunctorExpressionInterface $parent = null): string
    {
        return $this->formula()->expressionString($parent);
    }

    /**
     * @psalm-param array<string,mixed> $environment
     *
     * @throws \Tailors\Logic\Exceptions\InvalidArgumentException
     * @throws \Tailors\Logic\Exceptions\UndefinedVariableException
     */
    public function evaluate(array $environment = []): bool
    {
        return $this->formula()->evaluate(array_merge($environment, $this->environment()));
    }

    /**
     * @psalm-param array<string,mixed> $environment
     */
    public function where(array $environment): self
    {
        return new self($this, $environment);
    }
}
