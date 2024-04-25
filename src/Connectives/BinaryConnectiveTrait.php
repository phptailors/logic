<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Connectives;

use Tailors\Logic\FormulaInterface;

/**
 * @psalm-immutable
 */
trait BinaryConnectiveTrait
{
    public function with(FormulaInterface $f1, FormulaInterface $f2, FormulaInterface ...$f): FormulaInterface
    {
        return new ConnectiveFormula($this, $f1, $f2, ...$f);
    }

    /**
     * @psalm-return 2
     */
    public function arity(): int
    {
        return 2;
    }
}
