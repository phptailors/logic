<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

use Tailors\Logic\AbstractFunctorExpression;
use Tailors\Logic\Exceptions\InvalidArgumentException;
use Tailors\Logic\Exceptions\UndefinedVariableException;
use Tailors\Logic\TermInterface;

/**
 * @psalm-immutable
 *
 * @template-extends AbstractFunctorExpression<FunctionInterface, TermInterface>
 */
final class FunctionTerm extends AbstractFunctorExpression implements TermInterface
{
    public function __construct(FunctionInterface $function, TermInterface ...$arguments)
    {
        parent::__construct($function, $arguments);
    }

    public function function(): FunctionInterface
    {
        return $this->functor();
    }

    /**
     * @psalm-param array<string,mixed> $environment
     *
     * @throws InvalidArgumentException
     * @throws UndefinedVariableException
     */
    public function evaluate(array $environment = []): mixed
    {
        $arguments = array_map(fn (TermInterface $arg): mixed => $arg->evaluate($environment), $this->arguments());

        return $this->function()->apply(...$arguments);
    }
}
