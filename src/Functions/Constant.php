<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

use Tailors\Logic\FunctorExpressionInterface;
use Tailors\Logic\SymbolNotationTrait;
use Tailors\Logic\TermInterface;

/**
 * @psalm-immutable
 *
 * @psalm-template T
 *
 * @template-implements FunctionInterface<T>
 */
final class Constant implements FunctionInterface, TermInterface
{
    use SymbolNotationTrait;

    /**
     * @psalm-param T $value
     */
    public function __construct(private mixed $value) {}

    /**
     * @psalm-return 0
     */
    #[\Override]
    public function arity(): int
    {
        return 0;
    }

    /**
     * @param mixed $arguments
     *
     * @psalm-return T
     */
    #[\Override]
    public function apply(...$arguments)
    {
        return $this->value;
    }

    #[\Override]
    public function symbol(): string
    {
        return 'const';
    }

    #[\Override]
    public function expressionString(?FunctorExpressionInterface $parent = null): string
    {
        // FIXME: make it better
        return var_export($this->value, true);
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
    public function evaluate(array $environment = []): mixed
    {
        return $this->apply();
    }
}
