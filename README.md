# chubbyphp-deserialization

[![Build Status](https://api.travis-ci.org/chubbyphp/chubbyphp-deserialization.png?branch=master)](https://travis-ci.org/chubbyphp/chubbyphp-deserialization)
[![Total Downloads](https://poser.pugx.org/chubbyphp/chubbyphp-deserialization/downloads.png)](https://packagist.org/packages/chubbyphp/chubbyphp-deserialization)
[![Latest Stable Version](https://poser.pugx.org/chubbyphp/chubbyphp-deserialization/v/stable.png)](https://packagist.org/packages/chubbyphp/chubbyphp-deserialization)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/chubbyphp/chubbyphp-deserialization/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/chubbyphp/chubbyphp-deserialization/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/chubbyphp/chubbyphp-deserialization/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/chubbyphp/chubbyphp-deserialization/?branch=master)

## Description

A simple deserialization.

## Requirements

 * php: ~7.0
 * psr/log: ~1.0
 * symfony/yaml: ~2.7|~3.0

## Suggest

 * container-interop/container-interop: ~1.0
 * pimple/pimple: ~3.0

## Installation

Through [Composer](http://getcomposer.org) as [chubbyphp/chubbyphp-deserialization][1].

```sh
composer require chubbyphp/chubbyphp-deserialization "~2.0@dev"
```

## Usage

### Decoder

```php
<?php

use Chubbyphp\Deserialization\Decoder\Decoder;
use Chubbyphp\Deserialization\Decoder\JsonDecoderType;

$decoder = new Decoder([new JsonDecoderType]);

$data = $decoder->decode('{"name": "name"}', 'application/json');
print_r($data); // ['name' => 'name']
```

### Denormalizer

```php
<?php

use Chubbyphp\Deserialization\Denormalizer\Denormalizer;
use MyProject\Deserialization\ModelMapping;
use MyProject\Model\Model;

$logger = ...;

$denormalizer = new Denormalizer([new ModelMapping()], $logger);

$model = $denormalizer->denormalize(Model::class, ['name' => 'name']);

echo $model->getName(); // 'name'
```

### Deserializer

```php
<?php

use Chubbyphp\Deserialization\Decoder\Decoder;
use Chubbyphp\Deserialization\Decoder\JsonDecoderType;
use Chubbyphp\Deserialization\Denormalizer\Denormalizer;
use Chubbyphp\Deserialization\Deserializer;
use MyProject\Deserialization\ModelMapping;
use MyProject\Model\Model;

$logger = ...;

$deserializer = new Deserializer(
    new Decoder([new JsonDecoderType]),
    new Denormalizer([new ModelMapping()], $logger)
);

$model = $deserializer->deserialize(Model::class, '{"name": "name"}', 'application/json');

echo $model->getName(); // 'name'
```

### Mapping

```php
<?php

namespace MyProject\Deserialization;

use Chubbyphp\Deserialization\Mapping\DenormalizingFieldMappingBuilder;
use Chubbyphp\Deserialization\Mapping\DenormalizingFieldMappingInterface;
use Chubbyphp\Deserialization\Mapping\DenormalizingObjectMappingInterface;
use MyProject\Model\Model;

final class ModelMapping implements DenormalizingObjectMappingInterface
{
    /**
     * @return string
     */
    public function getClass(): string
    {
        return Model::class;
    }

    /**
     * @param string|null $type
     *
     * @return callable
     */
    public function getFactory(string $type = null): callable
    {
        return function () {
            return new Model();
        };
    }

    /**
     * @return DenormalizingFieldMappingInterface[]
     */
    public function getDenormalizingFieldMappings(): array
    {
        return [
            DenormalizingFieldMappingBuilder::create('name')->getMapping(),
        ];
    }
}
```

## Copyright

Dominik Zogg 2017


[1]: https://packagist.org/packages/chubbyphp/chubbyphp-deserialization
