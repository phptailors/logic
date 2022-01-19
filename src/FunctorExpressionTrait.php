<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic;

/**
 * @psalm-immutable
 * @psalm-template Functor of FunctorInterface
 * @psalm-template Argument of ExpressionInterface
 * @psalm-require-implements FunctorExpressionInterface
 */
trait FunctorExpressionTrait
{
    /**
     * @var Functor
     */
    private $functor;

    /**
     * @var array<Argument>
     */
    private $arguments;

    /**
     * @psalm-return array<Argument>
     */
    public function arguments(): array
    {
        return $this->arguments;
    }

    public function functor(): FunctorInterface
    {
        return $this->functor;
    }

    public function expressionString(FunctorExpressionInterface $parent = null): string
    {
        $symbol = $this->functor()->symbol();

        switch ($this->functor()->notation()) {
            case FunctorInterface::NOTATION_INFIX:
                return '('.$this->expressionArgumentsString(' '.$symbol.' ').')';

            case FunctorInterface::NOTATION_SUFFIX:
                return '('.$this->expressionArgumentsString(', ').')'.$symbol;

            case FunctorInterface::NOTATION_SYMBOL:
                return $symbol;

            default:
                return $symbol.'('.$this->expressionArgumentsString(', ').')';
        }
    }

    private function expressionArgumentsString(string $sep): string
    {
        return implode($sep, $this->expressionArgumentsList());
    }

    /**
     * @psalm-return array<string>
     */
    private function expressionArgumentsList(): array
    {
        $me = $this; // this tricks psalm to workaround ImpureFunctionCall below

        return array_map(function (ExpressionInterface $arg) use ($me) {
            return $arg->expressionString($me);
        }, $this->arguments());
    }
}
