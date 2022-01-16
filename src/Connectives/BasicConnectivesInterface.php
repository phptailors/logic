<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Connectives;

use Tailors\Logic\FormulaInterface;

/**
 * @psalm-immutable
 */
interface BasicConnectivesInterface
{
    public function and(FormulaInterface $f1, FormulaInterface $f2, FormulaInterface ...$f): FormulaInterface;

    public function or(FormulaInterface $f1, FormulaInterface $f2, FormulaInterface ...$f): FormulaInterface;
}
