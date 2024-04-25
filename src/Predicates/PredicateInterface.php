<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Predicates;

use Tailors\Logic\FunctorInterface;

/**
 * @psalm-immutable
 */
interface PredicateInterface extends FunctorInterface
{
    /**
     * @psalm-param mixed $arguments
     */
    public function apply(...$arguments): bool;
}
