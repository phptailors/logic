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
 * @template-implements FunctorExpressionInterface<Argument>
 */
abstract class AbstractFunctorExpression implements FunctorExpressionInterface
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
     * @psalm-param Functor $functor
     * @psalm-param array<Argument> $arguments
     */
    public function __construct(FunctorInterface $functor, array $arguments)
    {
        $this->functor = $functor;
        $this->arguments = $arguments;
    }

    /**
     * @psalm-return array<Argument>
     */
    public function arguments(): array
    {
        return $this->arguments;
    }

    /**
     * @psalm-return Functor
     */
    public function functor(): FunctorInterface
    {
        return $this->functor;
    }

    public function expressionString(FunctorExpressionInterface $parent = null): string
    {
        $symbol = $this->functor()->symbol();

        switch ($this->functor()->notation()) {
            case FunctorInterface::NOTATION_INFIX:
                $string = $this->expressionArgumentsString(' '.$symbol.' ');
                if ($this->expressionStringRequiresParentheses($parent)) {
                    return '('.$string.')';
                }

                    return $string;

            case FunctorInterface::NOTATION_SUFFIX:
                return '('.$this->expressionArgumentsString(', ').')'.$symbol;

            case FunctorInterface::NOTATION_SYMBOL:
                return $symbol;

            default:
                return $symbol.'('.$this->expressionArgumentsString(', ').')';
        }
    }

    private function expressionStringRequiresParentheses(FunctorExpressionInterface $parent = null): bool
    {
        if (null === $parent) {
            return false;
        }

        return (count($this->arguments()) > 1)
                && ($parent->functor()->precedence() < $this->functor()->precedence());
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
