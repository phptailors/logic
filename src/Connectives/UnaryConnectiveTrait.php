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
trait UnaryConnectiveTrait
{
    public function with(FormulaInterface $f1, FormulaInterface ...$f): FormulaInterface
    {
        return new ConnectiveFormula($this, $f1, ...$f);
    }

    /**
     * @psalm-return 1
     */
    public function arity(): int
    {
        return 1;
    }
}
