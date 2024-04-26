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

/**
 * @psalm-immutable
 */
interface TermInterface extends ExpressionInterface
{
    /**
     * @psalm-param array<string,mixed> $environment
     *
     * @return mixed
     *
     * @throws InvalidArgumentException
     */
    public function evaluate(array $environment = []);
}
