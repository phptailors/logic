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
use Tailors\Logic\QuantifiedFormula;

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

    /**
     * @psalm-param array<string,mixed> $environment
     *
     * @throws \Tailors\Logic\Exceptions\InvalidArgumentException
     * @throws \Tailors\Logic\Exceptions\UndefinedVariableException
     */
    public function evaluate(array $environment = []): bool
    {
        $arguments = array_map(
            function (FormulaInterface $arg) use ($environment): bool {
                return $arg->evaluate($environment);
            },
            $this->arguments()
        );

        return $this->connective()->apply(...$arguments);
    }

    /**
     * @psalm-param array<string,mixed> $environment
     */
    public function where(array $environment): QuantifiedFormula
    {
        return new QuantifiedFormula($this, $environment);
    }
}
