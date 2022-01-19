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
use Tailors\Logic\FunctorExpressionInterface;
use Tailors\Logic\FunctorExpressionTrait;

/**
 * @psalm-immutable
 * @template-implements FunctorExpressionInterface<FormulaInterface>
 */
final class ConnectiveFormula implements FormulaInterface, FunctorExpressionInterface
{
    /** @template-use FunctorExpressionTrait<ConnectiveInterface,FormulaInterface> */
    use FunctorExpressionTrait;

    public function __construct(ConnectiveInterface $functor, FormulaInterface ...$arguments)
    {
        $this->functor = $functor;
        $this->arguments = $arguments;
    }

    public function connective(): ConnectiveInterface
    {
        return $this->functor;
    }
}
