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
final class BinaryFunctionTraitTestObject implements FunctionInterface
{
    use BinaryFunctionTrait;

    /**
     * @throws \BadMethodCallException
     */
    public function symbol(): string
    {
        throw new \BadMethodCallException('not implemented');
    }

    /**
     * @throws \BadMethodCallException
     */
    public function notation(): int
    {
        throw new \BadMethodCallException('not implemented');
    }

    /**
     * @throws \BadMethodCallException
     */
    public function precedence(): int
    {
        throw new \BadMethodCallException('not implemented');
    }

    /**
     * @throws \BadMethodCallException
     */
    public function apply(...$arguments)
    {
        throw new \BadMethodCallException('not implemented');
    }
}
