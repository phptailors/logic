<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Validators;

use Tailors\Logic\Exceptions\InvalidArgumentException;

/**
 * @psalm-immutable
 *
 * @psalm-template ValidArglist of list
 */
interface ArglistValidatorInterface
{
    /**
     * @psalm-param list $arguments
     *
     * @psalm-assert ValidArglist $arguments
     *
     * @throws InvalidArgumentException
     */
    public function validate(string $symbol, array $arguments): void;
}
