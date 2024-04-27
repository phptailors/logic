<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Connectives;

/**
 * @psalm-immutable
 */
final class BinaryConnectiveTraitTestObject implements ConnectiveInterface
{
    use BinaryConnectiveTrait;

    public function symbol(): string
    {
        throw new \BadMethodCallException('not implemented');
    }

    public function notation(): int
    {
        throw new \BadMethodCallException('not implemented');
    }

    public function precedence(): int
    {
        throw new \BadMethodCallException('not implemented');
    }

    public function apply(bool ...$arguments): bool
    {
        throw new \BadMethodCallException('not implemented');
    }
}
