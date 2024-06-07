<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Validators;

/**
 * @psalm-immutable
 *
 * @psalm-type Options = array{
 *   comparatorArglist?: ComparatorArglistValidatorInterface,
 *   numbersArglist?: NumbersArglistValidatorInterface,
 * }
 */
final class BasicValidators implements BasicValidatorsInterface
{
    /**
     * @var ComparatorArglistValidatorInterface
     */
    private $comparatorArglist;

    /**
     * @var NumbersArglistValidatorInterface
     */
    private $numbersArglist;

    /**
     * @psalm-param Options $options
     */
    public function __construct(array $options = [])
    {
        $this->comparatorArglist = $options['comparatorArglist'] ?? new ComparatorArglistValidator();
        $this->numbersArglist = $options['numbersArglist'] ?? new NumbersArglistValidator();
    }

    #[\Override]
    public function comparatorArglist(): ComparatorArglistValidatorInterface
    {
        return $this->comparatorArglist;
    }

    #[\Override]
    public function numbersArglist(): NumbersArglistValidatorInterface
    {
        return $this->numbersArglist;
    }
}
