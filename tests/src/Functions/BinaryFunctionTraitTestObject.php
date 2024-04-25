<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

/**
 * @psalm-immutable
 * @psalm-template Ret
 * @template-implements FunctionInterface<Ret>
 */
abstract class BinaryFunctionTraitTestObject implements FunctionInterface
{
    use BinaryFunctionTrait;
}
