<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic;

use Tailors\Logic\Functions\BasicFunctionsInterface;

/**
 * @psalm-immutable
 */
interface LogicInterface extends BasicFunctionsInterface
{
    /**
     * @psalm-param non-empty-string $symbol
     */
    public function var(string $symbol): VariableInterface;
}
