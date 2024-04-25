<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Connectives;

use Tailors\Logic\FormulaInterface;

/**
 * Example usage.
 *
 * ```
 * class Logic
 * {
 *      use BasicConnectivesTrait;
 *
 *      public function __construct()
 *      {
 *          $this->basicConnectives = $this->makeBasicConnectives();
 *          // ...
 *      }
 * }
 * ```
 *
 * @psalm-immutable
 *
 * @psalm-type BasicConnectivesMap = array {
 *  and: Conjunction,
 *  or: Disjunction
 * }
 */
trait BasicConnectivesTrait
{
    /**
     * @var BasicConnectivesMap
     */
    private $basicConnectives;

    public function and(FormulaInterface $f1, FormulaInterface $f2, FormulaInterface ...$f): FormulaInterface
    {
        return $this->basicConnectives['and']->with($f1, $f2, ...$f);
    }

    public function or(FormulaInterface $f1, FormulaInterface $f2, FormulaInterface ...$f): FormulaInterface
    {
        return $this->basicConnectives['or']->with($f1, $f2, ...$f);
    }

    /**
     * @psalm-return BasicConnectivesMap
     */
    protected function makeBasicConnectives(): array
    {
        return [
            'and' => new Conjunction(),
            'or'  => new Disjunction(),
        ];
    }
}
