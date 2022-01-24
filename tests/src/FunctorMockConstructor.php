<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <ptomulik@meil.pw.edu.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-template MockedType of FunctorInterface
 *
 * @psalm-import-type Arity from FunctorInterface
 * @psalm-import-type Precedence from FunctorInterface
 *
 * @psalm-type FunctorMockParams = array{
 *      symbol?: string,
 *      arity?: Arity,
 *      notation?: FunctorInterface::NOTATION_*,
 *      precedence?: Precedence,
 *  }
 *
 * @psalm-suppress MissingThrowsDocblock
 */
final class FunctorMockConstructor
{
    public const DEFAULT_METHODS = [
        'arity',
        'notation',
        'precedence',
        'symbol',
    ];

    /** @var TestCase */
    private $test;

    /** @var class-string<MockedType> */
    private $class;

    /** @var array<string> */
    private $methods;

    /**
     * @psalm-param class-string<MockedType> $class
     * @psalm-param array<string> $methods
     */
    public function __construct(
        TestCase $test,
        string $class = FunctorInterface::class,
        array $methods = null
    ) {
        $this->test = $test;
        $this->class = $class;
        $this->methods = array_unique(array_merge(self::DEFAULT_METHODS, ($methods ?? [])));
    }

    /**
     * @psalm-param FunctorMockParams $params
     * @psalm-return MockObject&MockedType
     */
    public function getMock(array $params): MockObject
    {
        $functor = $this->test->getMockBuilder($this->class)
            ->onlyMethods($this->methods)
            ->getMock()
        ;

        foreach ($this->methods as $key) {
            if (isset($params[$key])) {
                $functor->expects($this->test->once())
                    ->method($key)
                    ->willReturn($params[$key])
                ;
            } else {
                $functor->expects($this->test->never())
                    ->method($key)
                ;
            }
        }

        return $functor;
    }
}
