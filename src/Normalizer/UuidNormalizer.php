<?php

namespace Gamez\Symfony\Component\Serializer\Normalizer;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class UuidNormalizer implements NormalizerInterface, DenormalizerInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): UuidInterface
    {
        if (!is_string($data)) {
            throw NotNormalizableValueException::createForUnexpectedDataType(sprintf('The data is not a valid "%s" string representation.', $type), $data, ['string']);
        }
        return Uuid::fromString($data);
    }

    /**
     * @param array<string, mixed> $context
     */
    public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
    {
        return is_string($data) && is_a($type, UuidInterface::class, true) && Uuid::isValid($data);
    }

    /**
     * @param UuidInterface $object
     * @param array<string, mixed> $context
     */
    public function normalize(mixed $object, string $format = null, array $context = []): string
    {
        return $object->toString();
    }

    /**
     * @param array<string, mixed> $context
     */
    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof UuidInterface;
    }

    /**
     * @param non-empty-string|null $format
     * @return array<class-string, bool>
     */
    public function getSupportedTypes(?string $format): array
    {
        return [
            UuidInterface::class => true,
        ];
    }
}
