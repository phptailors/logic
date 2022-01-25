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
        $notation = $this->functor()->notation();

        if (FunctorInterface::NOTATION_SYMBOL === $notation) {
            // symbol notation ignores arguments
            return $symbol;
        }

        $sep = $this->expressionStringArgumentSeparator($notation, $symbol);
        $arguments = implode($sep, $this->expressionArgumentsList());
        $expression = $this->expressionStringAssemble($notation, $symbol, $arguments);

        return $this->expressionStringRequiresParentheses($parent) ? ('('.$expression.')') : $expression;
    }

    /**
     * @psalm-param FunctorInterface::NOTATION_* $notation
     */
    private function expressionStringArgumentSeparator(int $notation, string $symbol): string
    {
        switch ($notation) {
            case FunctorInterface::NOTATION_FUNCTION:
                return ', ';

            case FunctorInterface::NOTATION_INFIX:
                return ' '.$symbol.' ';

            default:
                return ' ';
        }
    }

    /**
     * @psalm-param FunctorInterface::NOTATION_* $notation
     */
    private function expressionStringAssemble(int $notation, string $symbol, string $arguments): string
    {
        if (FunctorInterface::NOTATION_FUNCTION === $notation) {
            return $symbol.'('.$arguments.')';
        }

        if ('' === $arguments) {
            return $symbol;
        }

        if (FunctorInterface::NOTATION_PREFIX === $notation) {
            $expression = $symbol.' '.$arguments;
        } elseif (FunctorInterface::NOTATION_SUFFIX === $notation) {
            $expression = $arguments.' '.$symbol;
        } else {
            $expression = $arguments;
        }

        return $expression;
    }

    private function expressionStringRequiresParentheses(FunctorExpressionInterface $parent = null): bool
    {
        if (null === $parent) {
            return false;
        }

        $parentFunctor = $parent->functor();
        if (FunctorInterface::NOTATION_FUNCTION === $parentFunctor->notation()) {
            return false;
        }

        return (count($this->arguments()) > 1) && ($parentFunctor->precedence() < $this->functor()->precedence());
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
