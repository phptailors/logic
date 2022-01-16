<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

use Tailors\Logic\TermInterface;
use Tailors\Logic\Validators\BasicValidatorsInterface;

/**
 * Example usage.
 *
 * ```
 * class Logic
 * {
 *      use BasicFunctionsTrait;
 *
 *      public function __construct(BasicValidatorsInterface $validators)
 *      {
 *          $this->basicFunctions = $this->makeBasicFunctions($validators);
 *          // ...
 *      }
 * }
 * ```
 *
 * @psalm-immutable
 *
 * @psalm-type BasicFunctionsMap = array {
 *   sub: Sub,
 *   sum: Sum,
 * }
 */
trait BasicFunctionsTrait
{
    /**
     * @var BasicFunctionsMap
     */
    private $basicFunctions;

    /**
     * @param mixed $value
     */
    public function const($value): TermInterface
    {
        return new Constant($value);
    }

    public function sub(TermInterface $t1, TermInterface $t2, TermInterface ...$t): TermInterface
    {
        return $this->basicFunctions['sub']->with($t1, $t2, ...$t);
    }

    public function sum(TermInterface $t1, TermInterface $t2, TermInterface ...$t): TermInterface
    {
        return $this->basicFunctions['sum']->with($t1, $t2, ...$t);
    }

    /**
     * @psalm-return BasicFunctionsMap
     */
    protected function makeBasicFunctions(BasicValidatorsInterface $validators): array
    {
        return [
            'sub' => new Sub($validators->numbersArglist()),
            'sum' => new Sum($validators->numbersArglist()),
        ];
    }
}
