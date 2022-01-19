<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
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
     * @var mixed
     * @psalm-var T
     */
    private $value;

    /**
     * @psalm-param T $value
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @psalm-return 0
     */
    public function arity(): int
    {
        return 0;
    }

    /**
     * @param mixed $arguments
     * @psalm-return T
     */
    public function apply(...$arguments)
    {
        return $this->value;
    }

    public function symbol(): string
    {
        return 'const';
    }

    public function expressionString(FunctorExpressionInterface $parent = null): string
    {
        // FIXME: make it better
        return var_export($this->value, true);
    }
}
