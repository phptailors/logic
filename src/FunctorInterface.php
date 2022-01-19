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
 * Common interface for functions, predicates or connectives. A characteristic
 * feature of a functor is that it yields non-terminal expressions when
 * provided with arguments.
 *
 * @psalm-immutable
 *
 * @psalm-type Arity = 0|positive-int
 * @psalm-type Precedence = 0|positive-int
 */
interface FunctorInterface extends SymbolInterface
{
    public const NOTATION_PREFIX = 0;
    public const NOTATION_INFIX = 1;
    public const NOTATION_SUFFIX = 2;
    public const NOTATION_SYMBOL = 3;

    /**
     * @psalm-return Arity
     */
    public function arity(): int;

    /**
     * @psalm-return self::NOTATION_*
     */
    public function notation(): int;

    /**
     * @psalm-return Precedence
     *
     * @see https://www.php.net/manual/en/language.operators.precedence.php
     */
    public function precedence(): int;
}
