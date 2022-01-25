<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic;

/**
 * @psalm-immutable
 */
interface TermInterface extends ExpressionInterface
{
    /**
     * @psalm-param array<string,mixed> $environment
     *
     * @throws \Tailors\Logic\Exceptions\InvalidArgumentException
     *
     * @return mixed
     */
    public function evaluate(array $environment = []);
}
