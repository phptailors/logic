[![Unit Tests](https://github.com/phptailors/logic/actions/workflows/unit_test.yml/badge.svg)](https://github.com/phptailors/logic/actions/workflows/unit_test.yml)
[![Code Quality](https://github.com/phptailors/logic/actions/workflows/code_quality.yml/badge.svg)](https://github.com/phptailors/logic/actions/workflows/code_quality.yml)
[![Docs Tests](https://github.com/phptailors/logic/actions/workflows/docs_test.yml/badge.svg)](https://github.com/phptailors/logic/actions/workflows/docs_test.yml)
[![Docs Deploy](https://github.com/phptailors/logic/actions/workflows/docs_deploy.yml/badge.svg)](https://github.com/phptailors/logic/actions/workflows/docs_deploy.yml)
[![Type Coverage](https://shepherd.dev/github/phptailors/logic/coverage.svg)](https://shepherd.dev/github/phptailors/logic)
[![Code Coverage](https://codecov.io/gh/phptailors/logic/branch/master/graph/badge.svg?token=TWIzApc7Wd)](https://codecov.io/gh/phptailors/logic)

# Logic

First-order logic implementation in PHP

## Under development

The project is in initial phase. No releases yet!

## Quick intro

This library lets you construct and evaluate logical expressions. You may find
it useful when you need to impose constraints on user input or
arguments/options passed to a program or API.

## Example

```php
<?php
use Tailors\Logic\Logic;

$l = new Logic();

$formula = $l->and($l->bool($l->var('a')), $l->bool($l->var('b')));

var_export($formula->expressionString()); echo "\n";
var_export($formula->evaluate(['a' => 1, 'b' => true])); echo "\n";
var_export($formula->evaluate(['a' => true, 'b' => 0])); echo "\n";
```

The result of above is

```console
'bool(a) && bool(b)'
true
false
```

## Online documentation

- https://phptailors.github.io/logic/docs
