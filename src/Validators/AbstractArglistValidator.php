<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Validators;

use Tailors\Logic\Exceptions\InvalidArgumentException;

/**
 * @psalm-immutable
 *
 * @psalm-template ValidArglist of list
 *
 * @template-implements ArglistValidatorInterface<ValidArglist>
 */
abstract class AbstractArglistValidator implements ArglistValidatorInterface
{
    /**
     * @psalm-param list $arguments
     *
     * @psalm-assert ValidArglist $arguments
     *
     * @throws InvalidArgumentException
     */
    #[\Override]
    final public function validate(string $symbol, array $arguments): void
    {
        /** @var pure-callable(mixed,int):bool */
        $callback = fn (mixed $value, int $index): bool => $this->isValid($value, $index);

        $valid = array_filter($arguments, $callback, ARRAY_FILTER_USE_BOTH);
        $invalid = array_diff_key($arguments, $valid);
        if (count($invalid) > 0) {
            $message = $this->report($symbol, $invalid);

            throw new InvalidArgumentException($message);
        }
    }

    /**
     * @psalm-mutation-free
     *
     * @psalm-param non-empty-array<int,mixed> $invalidArgs
     */
    protected function report(string $symbol, array $invalidArgs): string
    {
        $positions = array_map(
            fn (int $index): string => (string) (1 + $index),
            array_keys($invalidArgs)
        );

        $last = array_pop($positions);
        if (0 === count($positions)) {
            return $this->reportSingle($symbol, $last);
        }
        $list = implode(' and ', [implode(', ', $positions), $last]);

        return $this->reportMultiple($symbol, $list);
    }

    /**
     * @psalm-mutation-free
     */
    abstract protected function isValid(mixed $value, int $index): bool;

    /**
     * @psalm-mutation-free
     */
    protected function reportSingle(string $symbol, string $arg): string
    {
        return sprintf('argument %s provided to %s %s', $arg, $symbol, $this->describeInvalidArguments(false));
    }

    /**
     * @psalm-mutation-free
     */
    protected function reportMultiple(string $symbol, string $arguments): string
    {
        return sprintf('arguments %s provided to %s %s', $arguments, $symbol, $this->describeInvalidArguments(true));
    }

    /**
     * @psalm-mutation-free
     */
    protected function describeInvalidArguments(bool $plural): string
    {
        return $plural ? 'are invalid' : 'is invalid';
    }
}
