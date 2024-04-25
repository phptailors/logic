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
trait FunctionNotationTrait
{
    /**
     * @psalm-return FunctorInterface::NOTATION_FUNCTION
     */
    final public function notation(): int
    {
        return FunctorInterface::NOTATION_FUNCTION;
    }

    /**
     * @psalm-return 0
     *
     * @see https://www.php.net/manual/en/language.operators.precedence.php
     */
    final public function precedence(): int
    {
        return 0;
    }
}
