<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Connectives;

use Tailors\Logic\AbstractFunctorExpression;
use Tailors\Logic\FormulaInterface;

/**
 * @psalm-immutable
 * @template-extends AbstractFunctorExpression<ConnectiveInterface,FormulaInterface>
 */
final class ConnectiveFormula extends AbstractFunctorExpression implements FormulaInterface
{
    public function __construct(ConnectiveInterface $connective, FormulaInterface ...$arguments)
    {
        parent::__construct($connective, $arguments);
    }

    public function connective(): ConnectiveInterface
    {
        return $this->functor();
    }
}
