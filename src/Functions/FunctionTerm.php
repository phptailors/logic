<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

use Tailors\Logic\FunctionalExpressionInterface;
use Tailors\Logic\FunctionalExpressionTrait;
use Tailors\Logic\TermInterface;

/**
 * @psalm-immutable
 * @template-implements FunctionalExpressionInterface<TermInterface>
 */
final class FunctionTerm implements TermInterface, FunctionalExpressionInterface
{
    /** @template-use FunctionalExpressionTrait<FunctionInterface,TermInterface> */
    use FunctionalExpressionTrait;

    public function __construct(FunctionInterface $function, TermInterface ...$arguments)
    {
        $this->functional = $function;
        $this->arguments = $arguments;
    }

    public function function(): FunctionInterface
    {
        return $this->functional;
    }
}
