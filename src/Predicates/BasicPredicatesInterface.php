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

/**
 * @psalm-immutable
 */
interface BasicPredicatesInterface
{
    public function tee(): Tee;

    public function falsum(): Falsum;

    /**
     * @no-named-arguments
     */
    public function bool(TermInterface $t1): FormulaInterface;

    /**
     * @no-named-arguments
     */
    public function equal(TermInterface $t1, TermInterface $t2): FormulaInterface;

    /**
     * @no-named-arguments
     */
    public function notEqual(TermInterface $t1, TermInterface $t2): FormulaInterface;

    /**
     * @no-named-arguments
     */
    public function same(TermInterface $t1, TermInterface $t2): FormulaInterface;

    /**
     * @no-named-arguments
     */
    public function notSame(TermInterface $t1, TermInterface $t2): FormulaInterface;

    /**
     * @no-named-arguments
     */
    public function gt(TermInterface $t1, TermInterface $t2): FormulaInterface;

    /**
     * @no-named-arguments
     */
    public function lt(TermInterface $t1, TermInterface $t2): FormulaInterface;

    /**
     * @no-named-arguments
     */
    public function ge(TermInterface $t1, TermInterface $t2): FormulaInterface;

    /**
     * @no-named-arguments
     */
    public function le(TermInterface $t1, TermInterface $t2): FormulaInterface;
}
