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
interface ExpressionInterface
{
    /**
     * @psalm-template Argument of ExpressionInterface
     * @psalm-param FunctionalExpressionInterface<Argument> $parent
     */
    public function expressionString(FunctionalExpressionInterface $parent = null): string;
}
