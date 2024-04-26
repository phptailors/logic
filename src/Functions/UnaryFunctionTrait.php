<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic\Functions;

use Tailors\Logic\TermInterface;

/**
 * @psalm-immutable
 *
 * @pslam-require-implements FunctionInterface
 */
trait UnaryFunctionTrait
{
    public function with(TermInterface $t1, TermInterface ...$t): FunctionTerm
    {
        return new FunctionTerm($this, $t1, ...$t);
    }

    /**
     * @psalm-return 1
     */
    public function arity(): int
    {
        return 1;
    }
}
