<?php

namespace Gamez\Symfony\Component\Serializer\Normalizer;

use Gamez\Symfony\Component\Serializer\Normalizer\UuidNormalizer;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UuidNormalizerTest extends TestCase
{
    private UuidNormalizer $normalizer;
    private UuidInterface $uuid;

    protected function setUp(): void
    {
        $this->normalizer = new UuidNormalizer();
        $this->uuid = Uuid::uuid4();
    }

    /** @test */
    public function it_normalizes_uuids(): void
    {
        $this->assertTrue($this->normalizer->supportsNormalization($this->uuid));
        $this->assertSame($this->uuid->toString(), $this->normalizer->normalize($this->uuid));
    }

    /** @test */
    public function it_denormalizes_uuid_strings(): void
    {
        $this->assertTrue($this->normalizer->supportsDenormalization($this->uuid->toString(), Uuid::class));
        $this->assertTrue($this->normalizer->supportsDenormalization($this->uuid->toString(), UuidInterface::class));

        $result = $this->normalizer->denormalize($this->uuid->toString(), Uuid::class);
        $this->assertTrue($this->uuid->equals($result));
    }
}
