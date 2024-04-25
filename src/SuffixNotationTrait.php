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
trait SuffixNotationTrait
{
    /**
     * @psalm-return FunctorInterface::NOTATION_SUFFIX
     */
    final public function notation(): int
    {
        return FunctorInterface::NOTATION_SUFFIX;
    }
}
