<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
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

    #[\Override]
    public function symbol(): string
    {
        return '&&';
    }

    #[\Override]
    public function apply(bool ...$arguments): bool
    {
        if (0 === count($arguments)) {
            return false;
        }

        $last = array_pop($arguments);

        return array_reduce(
            $arguments,
            fn(bool $result, bool $arg): bool => $result && $arg,
            $last
        );
    }

    /**
     * @psalm-return 15
     *
     * @see https://www.php.net/manual/en/language.operators.precedence.php
     */
    #[\Override]
    public function precedence(): int
    {
        return 15;
    }
}
