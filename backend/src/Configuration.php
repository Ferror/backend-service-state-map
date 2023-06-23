<?php

declare(strict_types=1);

namespace App;

use App\DataScraper\Data;
use Symfony\Component\Serializer\SerializerInterface;

final class Configuration
{
    public function __construct(private SerializerInterface $serializer)
    {
    }

    public function getServices(): Data
    {
        $json = file_get_contents(__DIR__ . '/DataScraper/data.json');

        return $this->serializer->deserialize($json, Data::class, 'json');
    }
}
