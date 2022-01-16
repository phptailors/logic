<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Validators;

/**
 * @psalm-immutable
 */
interface BasicValidatorsInterface
{
    public function comparatorArglist(): ComparatorArglistValidatorInterface;

    public function numbersArglist(): NumbersArglistValidatorInterface;
}
