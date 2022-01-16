<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

/**
 * @psalm-immutable
 *
 * @psalm-type Arglist = list
 * @psalm-template Arity of 0|positive-int
 * @psalm-template Ret
 * @psalm-template ValidArglist of Arglist
 *
 * @template-implements FunctionInterface<Ret>
 */
abstract class AbstractFunction implements FunctionInterface
{
    /**
     * @psalm-param mixed $arguments
     * @psalm-return Ret
     *
     * @throws \Tailors\Logic\Exceptions\InvalidArgumentException
     */
    final public function apply(...$arguments)
    {
        $argumentsList = array_values($arguments);
        $this->validate($argumentsList);

        return $this->applyImpl($argumentsList);
    }

    /**
     * @psalm-param ValidArglist $arguments
     * @psalm-return Ret
     */
    abstract protected function applyImpl(array $arguments);

    /**
     * @psalm-param Arglist $arguments
     * @psalm-assert ValidArglist $arguments
     *
     * @throws \Tailors\Logic\Exceptions\InvalidArgumentException
     */
    abstract protected function validate(array $arguments): void;
}
