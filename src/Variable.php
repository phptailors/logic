<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic;

use Tailors\Logic\Exceptions\UndefinedVariableException;

/**
 * @psalm-immutable
 */
final readonly class Variable implements VariableInterface
{
    /**
     * @psalm-param non-empty-string $symbol
     */
    public function __construct(private string $symbol) {}

    #[\Override]
    public function symbol(): string
    {
        return $this->symbol;
    }

    #[\Override]
    public function expressionString(?FunctorExpressionInterface $parent = null): string
    {
        return $this->symbol;
    }

    /**
     * @psalm-param array<string,mixed> $environment
     *
     * @throws UndefinedVariableException
     */
    #[\Override]
    public function evaluate(array $environment = []): mixed
    {
        $key = $this->symbol();

        if (!array_key_exists($key, $environment)) {
            throw new UndefinedVariableException("undefined variable: {$key}");
        }

        return $environment[$key];
    }
}
