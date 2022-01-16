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
 * @psalm-template Functional of FunctionalInterface
 * @psalm-template Argument of ExpressionInterface
 */
trait FunctionalExpressionTrait
{
    /**
     * @var Functional
     */
    private $functional;

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

    public function functional(): FunctionalInterface
    {
        return $this->functional;
    }

    public function expressionString(): string
    {
        $symbol = $this->functional()->symbol();

        switch ($this->functional()->notation()) {
            case FunctionalInterface::NOTATION_INFIX:
                return '('.$this->expressionArgumentsString(' '.$symbol.' ').')';

            case FunctionalInterface::NOTATION_SUFFIX:
                return '('.$this->expressionArgumentsString(', ').')'.$symbol;

            case FunctionalInterface::NOTATION_SYMBOL:
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
        return array_map(function (ExpressionInterface $arg) {
            return $arg->expressionString();
        }, $this->arguments());
    }
}
