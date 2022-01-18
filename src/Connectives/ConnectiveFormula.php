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
use Tailors\Logic\FunctionalExpressionInterface;
use Tailors\Logic\FunctionalExpressionTrait;

/**
 * @psalm-immutable
 * @template-implements FunctionalExpressionInterface<FormulaInterface>
 */
final class ConnectiveFormula implements FormulaInterface, FunctionalExpressionInterface
{
    /** @template-use FunctionalExpressionTrait<ConnectiveInterface,FormulaInterface> */
    use FunctionalExpressionTrait;

    public function __construct(ConnectiveInterface $functional, FormulaInterface ...$arguments)
    {
        $this->functional = $functional;
        $this->arguments = $arguments;
    }

    public function connective(): ConnectiveInterface
    {
        return $this->functional;
    }
}
