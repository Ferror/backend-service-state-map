<?php

declare(strict_types=1);

namespace App\DataScraper;

final readonly class Service
{
    /**
     * @param InfoSource[] $infoSources
     */
    public function __construct(
        public string $organisation,
        public string $name,
        public string $description,
        public array $infoSources,
    ) {
    }
}
