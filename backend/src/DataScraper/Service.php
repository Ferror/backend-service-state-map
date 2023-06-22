<?php

declare(strict_types=1);

namespace App\DataScraper;

final readonly class Service
{
    public function __construct(
        public string $name,
        public string $description,
        public array $infoSources,
    ) {
    }
}
