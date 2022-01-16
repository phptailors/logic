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
trait PrefixNotationTrait
{
    /**
     * @psalm-return FunctionalInterface::NOTATION_PREFIX
     */
    public function notation(): int
    {
        return FunctionalInterface::NOTATION_PREFIX;
    }
}
