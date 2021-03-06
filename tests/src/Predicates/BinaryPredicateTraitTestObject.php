<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Predicates;

/**
 * @psalm-immutable
 * @psalm-template Ret
 */
abstract class BinaryPredicateTraitTestObject implements PredicateInterface
{
    use BinaryPredicateTrait;
}
