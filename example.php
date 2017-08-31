<?php

require_once __DIR__.'/vendor/autoload.php';

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

$person = $serializer->deserialize($json, Person::class, 'json');
var_dump($person);


