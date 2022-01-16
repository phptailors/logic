<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

use Tailors\Logic\FunctionalInterface;

/**
 * @psalm-immutable
 *
 * @psalm-template Ret
 */
interface FunctionInterface extends FunctionalInterface
{
    /**
     * @psalm-param mixed $arguments
     * @psalm-return Ret
     */
    public function apply(...$arguments);
}
