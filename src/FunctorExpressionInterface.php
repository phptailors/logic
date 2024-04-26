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
 *
 * @psalm-template Argument of ExpressionInterface
 */
interface FunctorExpressionInterface
{
    /**
     * @psalm-return array<Argument>
     */
    public function arguments(): array;

    public function functor(): FunctorInterface;
}
