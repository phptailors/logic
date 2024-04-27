<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

/**
 * @psalm-immutable
 *
 * @psalm-template Ret
 *
 * @template-implements FunctionInterface<Ret>
 */
final class UnaryFunctionTraitTestObject implements FunctionInterface
{
    use UnaryFunctionTrait;

    public function symbol(): string
    {
        throw new \BadMethodCallException('not implemented');
    }

    public function notation(): int
    {
        throw new \BadMethodCallException('not implemented');
    }

    public function precedence(): int
    {
        throw new \BadMethodCallException('not implemented');
    }

    public function apply(...$arguments)
    {
        throw new \BadMethodCallException('not implemented');
    }
}
