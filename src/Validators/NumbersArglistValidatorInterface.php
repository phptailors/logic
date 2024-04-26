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
 *
 * @psalm-type Number = int|float
 * @psalm-type Arglist = list
 * @psalm-type ValidArglist = list<Number>
 *
 * @template-implements ArglistValidatorInterface<Arglist,ValidArglist>
 */
interface NumbersArglistValidatorInterface extends ArglistValidatorInterface {}
