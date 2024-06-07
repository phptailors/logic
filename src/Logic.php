<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic;

use Tailors\Logic\Connectives\BasicConnectivesTrait;
use Tailors\Logic\Functions\BasicFunctionsTrait;
use Tailors\Logic\Predicates\BasicPredicatesTrait;
use Tailors\Logic\Validators\BasicValidators;
use Tailors\Logic\Validators\BasicValidatorsInterface;

/**
 * @psalm-immutable
 *
 * @psalm-type Options = array{
 *  basicValidators?: BasicValidatorsInterface
 * }
 */
final class Logic implements LogicInterface
{
    use BasicFunctionsTrait;
    use BasicPredicatesTrait;
    use BasicConnectivesTrait;

    /**
     * @psalm-param Options $options
     */
    public function __construct(array $options = [])
    {
        $basicValidators = $options['basicValidators'] ?? new BasicValidators();
        $this->basicFunctions = $this->makeBasicFunctions($basicValidators);
        $this->basicPredicates = $this->makeBasicPredicates($basicValidators);
        $this->basicConnectives = $this->makeBasicConnectives();
    }

    #[\Override]
    public function var(string $symbol): VariableInterface
    {
        return new Variable($symbol);
    }
}
