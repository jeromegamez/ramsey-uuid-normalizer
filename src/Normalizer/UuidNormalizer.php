<?php

namespace Gamez\Symfony\Component\Serializer\Normalizer;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UuidNormalizer implements NormalizerInterface, DenormalizerInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): UuidInterface
    {

        return Uuid::fromString($data);
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null): bool
    {
        return is_string($data) && is_a($type, UuidInterface::class, true) && Uuid::isValid($data);
    }

    /**
     * @param array<string, mixed> $context
     */
    public function normalize(mixed $object, string $format = null, array $context = []): string
    {
        return $object->toString();
    }

    public function supportsNormalization(mixed $data, string $format = null): bool
    {
        return $data instanceof UuidInterface;
    }
}
