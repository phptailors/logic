<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
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
     * @psalm-param FunctorExpressionInterface<Argument> $parent
     */
    public function expressionString(FunctorExpressionInterface $parent = null): string;
}
