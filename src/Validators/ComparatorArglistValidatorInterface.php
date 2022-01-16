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
 *
 * @psalm-type Comparable = int|float|bool
 * @psalm-type Arglist = array
 * @psalm-type ValidArglist = array<Comparable>
 * @template-implements ArglistValidatorInterface<Arglist, ValidArglist>
 */
interface ComparatorArglistValidatorInterface extends ArglistValidatorInterface
{
}
