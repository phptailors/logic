<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

use Tailors\Logic\FunctorExpressionInterface;
use Tailors\Logic\FunctorExpressionTrait;
use Tailors\Logic\TermInterface;

/**
 * @psalm-immutable
 * @template-implements FunctorExpressionInterface<TermInterface>
 */
final class FunctionTerm implements TermInterface, FunctorExpressionInterface
{
    /** @template-use FunctorExpressionTrait<FunctionInterface,TermInterface> */
    use FunctorExpressionTrait;

    public function __construct(FunctionInterface $function, TermInterface ...$arguments)
    {
        $this->functor = $function;
        $this->arguments = $arguments;
    }

    public function function(): FunctionInterface
    {
        return $this->functor;
    }
}
