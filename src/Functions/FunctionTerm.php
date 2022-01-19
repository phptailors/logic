<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

use Tailors\Logic\AbstractFunctorExpression;
use Tailors\Logic\TermInterface;

/**
 * @psalm-immutable
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
}
