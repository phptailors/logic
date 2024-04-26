<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Predicates;

use Tailors\Logic\AbstractFunctorExpression;
use Tailors\Logic\Exceptions\InvalidArgumentException;
use Tailors\Logic\Exceptions\UndefinedVariableException;
use Tailors\Logic\FormulaInterface;
use Tailors\Logic\QuantifiedFormula;
use Tailors\Logic\TermInterface;

/**
 * @psalm-immutable
 *
 * @template-extends AbstractFunctorExpression<PredicateInterface,TermInterface>
 */
final class PredicateFormula extends AbstractFunctorExpression implements FormulaInterface
{
    public function __construct(PredicateInterface $predicate, TermInterface ...$arguments)
    {
        parent::__construct($predicate, $arguments);
    }

    public function predicate(): PredicateInterface
    {
        return $this->functor();
    }

    /**
     * @psalm-param array<string,mixed> $environment
     *
     * @throws InvalidArgumentException
     * @throws UndefinedVariableException
     */
    public function evaluate(array $environment = []): bool
    {
        $arguments = array_map(
            /** @return mixed */
            function (TermInterface $arg) use ($environment) {
                return $arg->evaluate($environment);
            },
            $this->arguments()
        );

        return $this->predicate()->apply(...$arguments);
    }

    /**
     * @psalm-param array<string,mixed> $environment
     */
    public function where(array $environment): QuantifiedFormula
    {
        return new QuantifiedFormula($this, $environment);
    }
}
