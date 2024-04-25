<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Validators;

/**
 * @psalm-immutable
 * @psalm-template Arglist of array
 * @psalm-template ValidArglist of array
 */
interface ArglistValidatorInterface
{
    /**
     * @psalm-param Arglist $arguments
     * @psalm-assert ValidArglist $arguments
     *
     * @throws \Tailors\Logic\Exceptions\InvalidArgumentException
     */
    public function validate(string $symbol, array $arguments): void;
}
