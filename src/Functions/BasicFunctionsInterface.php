<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

use Tailors\Logic\TermInterface;

/**
 * @psalm-immutable
 */
interface BasicFunctionsInterface
{
    /**
     * @param mixed $value
     */
    public function const($value): TermInterface;

    public function sub(TermInterface $t1, TermInterface $t2, TermInterface ...$t): TermInterface;

    public function sum(TermInterface $t1, TermInterface $t2, TermInterface ...$t): TermInterface;
}
