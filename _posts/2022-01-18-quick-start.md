---
title: "Quick start"
date: 2022-01-18T22:01:38+01:00
categories:
  - blog
tags:
  - Quick Start
  - docs
---

In this guide we'll create a simple project and write a logical expression.

Create project directories

```console
user@pc:$ mkdir -p /tmp/myproj/tests && cd /tmp/myproj
```

Add the following ``composer.json`` file

```json
{
    "name": "myproj/myproj",
    "minimum-stability": "dev",
    "prefer-stable": true,
    "authors": [
        {
            "name": "My Project",
            "email": "myproj@myproj.org"
        }
    ],
    "require-dev": {
        "phpunit/phpunit": "^9.5.0",
        "phptailors/logic": "dev-master"
    },
    "autoload-dev": {
        "psr-4": {
          "MyProj\\": [
            "src/",
            "tests/"
          ]
        }
    }
}
```

Intall composer packages

```console
user@pc:$ composer install
```

Add the following ``tests/LogicTest.php`` file

```php
<?php declare(strict_types=1);

namespace MyProj;

use Tailors\Logic\Logic;

class LogicTest extends \PHPUnit\Framework\TestCase
{
    public function testLogicalExpression(): void
    {
        $l = new Logic();
        $expression = $l->or($l->tee(), $l->falsum());
        $this->assertSame("(⊤ || ⊥)", $expression->expressionString());
    }
}
```

Run PHPUnit

```console
PHPUnit 9.5.11 by Sebastian Bergmann and contributors.

.                                                                   1 / 1 (100%)

Time: 00:00.003, Memory: 4.00 MB

OK (1 test, 1 assertion)
```

[phpunit]: https://phpunit.de
