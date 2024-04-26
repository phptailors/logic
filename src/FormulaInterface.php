<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic;

use Tailors\Logic\Exceptions\InvalidArgumentException;
use Tailors\Logic\Exceptions\UndefinedVariableException;

/**
 * @psalm-immutable
 */
interface FormulaInterface extends ExpressionInterface
{
    /**
     * @psalm-param array<string,mixed> $environment
     *
     * @throws InvalidArgumentException
     * @throws UndefinedVariableException
     */
    public function evaluate(array $environment = []): bool;

    /**
     * @psalm-param array<string,mixed> $environment
     */
    public function where(array $environment): FormulaInterface;
}
