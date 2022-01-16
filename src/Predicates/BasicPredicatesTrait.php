<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Predicates;

use Tailors\Logic\Validators\BasicValidatorsInterface;

/**
 * Example usage.
 *
 * ```
 * class Logic
 * {
 *      use BasicPredicatesTrait;
 *
 *      public function __construct(BasicValidatorsInterface $validators)
 *      {
 *          $this->basicPredicates = $this->makeBasicPredicates($validators);
 *          // ...
 *      }
 * }
 * ```
 *
 * @psalm-immutable
 *
 * @psalm-type BasicPredicatesMap = array {
 *  tee: Tee,
 *  falsum: Falsum
 * }
 */
trait BasicPredicatesTrait
{
    /**
     * @var BasicPredicatesMap
     */
    private $basicPredicates;

    public function tee(): Tee
    {
        return $this->basicPredicates['tee'];
    }

    public function falsum(): Falsum
    {
        return $this->basicPredicates['falsum'];
    }

    /**
     * @psalm-return BasicPredicatesMap
     */
    protected function makeBasicPredicates(BasicValidatorsInterface $validators): array
    {
        return [
            'tee'    => new Tee(),
            'falsum' => new Falsum(),
        ];
    }
}
