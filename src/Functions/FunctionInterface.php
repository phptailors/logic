<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

use Tailors\Logic\FunctorInterface;

/**
 * @psalm-immutable
 *
 * @psalm-template Ret
 */
interface FunctionInterface extends FunctorInterface
{
    /**
     * @psalm-param mixed $arguments
     *
     * @psalm-return Ret
     */
    public function apply(...$arguments);
}
