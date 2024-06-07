<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Predicates;

use Tailors\Logic\FormulaInterface;
use Tailors\Logic\TermInterface;
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
 *  falsum: Falsum,
 *  bool: BoolValue,
 *  '==': Equal,
 *  '!=': NotEqual,
 *  '===': Same,
 *  '!==': NotSame,
 *  '>': GreaterThan,
 *  '<': LessThan,
 *  '>=': GreaterEqual,
 *  '<=': LessEqual,
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

    public function bool(TermInterface $t1): FormulaInterface
    {
        return $this->basicPredicates['bool']->with($t1);
    }

    public function equal(TermInterface $t1, TermInterface $t2): FormulaInterface
    {
        return $this->basicPredicates['==']->with($t1, $t2);
    }

    public function notEqual(TermInterface $t1, TermInterface $t2): FormulaInterface
    {
        return $this->basicPredicates['!=']->with($t1, $t2);
    }

    public function same(TermInterface $t1, TermInterface $t2): FormulaInterface
    {
        return $this->basicPredicates['===']->with($t1, $t2);
    }

    public function notSame(TermInterface $t1, TermInterface $t2): FormulaInterface
    {
        return $this->basicPredicates['!==']->with($t1, $t2);
    }

    public function gt(TermInterface $t1, TermInterface $t2): FormulaInterface
    {
        return $this->basicPredicates['>']->with($t1, $t2);
    }

    public function lt(TermInterface $t1, TermInterface $t2): FormulaInterface
    {
        return $this->basicPredicates['<']->with($t1, $t2);
    }

    public function ge(TermInterface $t1, TermInterface $t2): FormulaInterface
    {
        return $this->basicPredicates['>=']->with($t1, $t2);
    }

    public function le(TermInterface $t1, TermInterface $t2): FormulaInterface
    {
        return $this->basicPredicates['<=']->with($t1, $t2);
    }

    /**
     * @psalm-return BasicPredicatesMap
     *
     * @psalm-suppress PossiblyUnusedParam
     */
    protected function makeBasicPredicates(BasicValidatorsInterface $validators): array
    {
        return [
            'tee'    => new Tee(),
            'falsum' => new Falsum(),
            'bool'   => new BoolValue(),
            '=='     => new Equal(),
            '!='     => new NotEqual(),
            '==='    => new Same(),
            '!=='    => new NotSame(),
            '>'      => new GreaterThan(),
            '<'      => new LessThan(),
            '>='     => new GreaterEqual(),
            '<='     => new LessEqual(),
        ];
    }
}
