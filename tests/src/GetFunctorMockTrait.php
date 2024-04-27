<?php declare(strict_types=1);

/*
 * This file is part of phptailors/logic.
 *
 * Copyright (c) Paweł Tomulik <pawel@tomulik.pl>
 *
 * View the LICENSE file for full copyright and license information.
 */

namespace Tailors\Logic;

use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Rule\InvokedCount;

/**
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
trait GetFunctorMockTrait
{
    /**
     * @psalm-template<MockedType> of FunctorInterface
     *
     * @psalm-param FunctorMockParams $params
     * @psalm-param class-string<MockedType> $class
     * @psalm-param array<string,bool> $methods
     *
     * @psalm-return MockObject&MockedType
     */
    public function getFunctorMock(array $params, string $class = FunctorInterface::class, array $methods = []): MockObject
    {
        static $defaultMethods = [
            'arity'      => true,
            'notation'   => true,
            'precedence' => true,
            'symbol'     => true,
        ];

        $methods = array_merge($defaultMethods, $methods);

        $functor = $this->getMockBuilder($class)
            ->onlyMethods(array_keys($methods))
            ->getMock()
        ;

        foreach ($methods as $key => $flag) {
            if (isset($params[$key])) {
                $functor->expects($this->once())
                    ->method($key)
                    ->willReturn($params[$key])
                ;
            } elseif ($flag) {
                $functor->expects($this->never())
                    ->method($key)
                ;
            }
        }

        return $functor;
    }

    abstract protected function getMockBuilder(string $className): MockBuilder;

    abstract protected function once(): InvokedCount;

    abstract protected function never(): InvokedCount;
}
