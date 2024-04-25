<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Connectives;

use Tailors\Logic\FunctorInterface;

/**
 * @psalm-immutable
 */
interface ConnectiveInterface extends FunctorInterface
{
    public function apply(bool ...$arguments): bool;
}
