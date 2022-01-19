<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Connectives;

use Tailors\Logic\InfixNotationTrait;

/**
 * @psalm-immutable
 */
final class Conjunction implements ConnectiveInterface
{
    use InfixNotationTrait;
    use BinaryConnectiveTrait;

    public function symbol(): string
    {
        return '&&';
    }

    public function apply(bool ...$arguments): bool
    {
        if (0 === count($arguments)) {
            return false;
        }

        $last = array_pop($arguments);

        return array_reduce(
            $arguments,
            function (bool $result, bool $arg): bool {
                return $result && $arg;
            },
            $last
        );
    }

    /**
     * @psalm-return 15
     *
     * @see https://www.php.net/manual/en/language.operators.precedence.php
     */
    public function precedence(): int
    {
        return 15;
    }
}
