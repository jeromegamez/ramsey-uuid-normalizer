<?php

namespace Gamez\Symfony\Component\Serializer\Normalizer\Tests;

use Gamez\Symfony\Component\Serializer\Normalizer\UuidNormalizer;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UuidNormalizerTest extends TestCase
{
    /**
     * @var UuidNormalizer
     */
    private $normalizer;

    /**
     * @var Uuid
     */
    private $uuid;

    protected function setUp()
    {
        $this->normalizer = new UuidNormalizer();
        $this->uuid = Uuid::uuid4();
    }

    /** @test */
    public function it_normalizes_uuids()
    {
        $this->assertTrue($this->normalizer->supportsNormalization($this->uuid));
        $this->assertSame($this->uuid->toString(), $this->normalizer->normalize($this->uuid));
    }

    /** @test */
    public function it_denormalizes_uuid_strings()
    {
        $this->assertTrue($this->normalizer->supportsDenormalization($this->uuid->toString(), Uuid::class));
        $this->assertTrue($this->normalizer->supportsDenormalization($this->uuid->toString(), UuidInterface::class));

        $result = $this->normalizer->denormalize($this->uuid->toString(), Uuid::class);
        $this->assertInstanceOf(UuidInterface::class, $result);
        $this->assertTrue($this->uuid->equals($result));
    }
}
