<?php

declare(strict_types=1);

namespace App\Tests;

use App\Configuration;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

final class ConfigurationTest extends KernelTestCase
{
    public function testConfiguration(): void
    {
        $serializer = static::getContainer()->get('serializer');
//        $normalizer = new ObjectNormalizer(null, null, null, null);
//        $serializer = new Serializer([new DateTimeNormalizer(), $normalizer]);
        $config = new Configuration($serializer);

        var_dump($config->getServices());
    }
}
