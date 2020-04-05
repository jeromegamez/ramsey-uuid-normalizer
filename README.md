# Symfony Normalizer and Denormalizer for [ramsey/uuid](https://github.com/ramsey/uuid)

[![Latest Stable Version](https://poser.pugx.org/gamez/ramsey-uuid-normalizer/v/stable)](https://packagist.org/packages/gamez/ramsey-uuid-normalizer)
[![Total Downloads](https://poser.pugx.org/gamez/ramsey-uuid-normalizer/downloads)](https://packagist.org/packages/gamez/ramsey-uuid-normalizer/stats)
[![Build Status](https://travis-ci.org/jeromegamez/ramsey-uuid-normalizer.svg?branch=master)](https://travis-ci.org/jeromegamez/ramsey-uuid-normalizer)
[![Sponsor](https://img.shields.io/static/v1?logo=GitHub&label=Sponsor&message=%E2%9D%A4&color=ff69b4)](https://github.com/sponsors/jeromegamez)

## Installation

The utility can be installed with [Composer]:

```bash
$ composer require gamez/ramsey-uuid-normalizer
```

## Usage

### Symfony Serializer Component

The usage example requires the [PropertyAccess Component] component,
which can also be installed with [Composer]:

```bash
$ composer require symfony/property-access
```

```php
use Gamez\Symfony\Component\Serializer\Normalizer\UuidNormalizer;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class Person
{
    public $id;
    public $name;
}

$person = new Person();
$person->id = Uuid::uuid4();
$person->name = 'Jérôme Gamez';

$encoders = [new JsonEncoder()];
$normalizers = [new UuidNormalizer(), new ObjectNormalizer()];
$serializer = new Serializer($normalizers, $encoders);

$json = $serializer->serialize($person, 'json');
echo $json.PHP_EOL;
// {"id":"3d79048c-29e7-482f-979a-5b9a708b2ede","name":"J\u00e9r\u00f4me Gamez"}

$person = $serializer->deserialize($json, Person::class, 'json');
var_dump($person);
/*
class Person#27 (2) {
  public $id =>
  string(36) "3d79048c-29e7-482f-979a-5b9a708b2ede"
  public $name =>
  string(14) "Jérôme Gamez"
}
*/
```

For further information on how to use the Symfony Serializer Component,
please see [The Serializer Component] in the official documentation.

[Composer]: https://getcomposer.org
[PropertyAccess Component]: https://github.com/symfony/property-access
[The Serializer Component]: https://symfony.com/doc/current/components/serializer.html 
