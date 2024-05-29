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
 * @psalm-type Comparable = int|float|bool
 * @psalm-type ValidArglist = list<Comparable>
 *
 * @template-extends ArglistValidatorInterface<ValidArglist>
 */
interface ComparatorArglistValidatorInterface extends ArglistValidatorInterface {}
