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
final class Variable implements VariableInterface
{
    /**
     * @var non-empty-string
     */
    private $symbol;

    /**
     * @psalm-param non-empty-string $symbol
     */
    public function __construct(string $symbol)
    {
        $this->symbol = $symbol;
    }

    public function symbol(): string
    {
        return $this->symbol;
    }

    public function expressionString(FunctorExpressionInterface $parent = null): string
    {
        return $this->symbol;
    }
}
