<?php

declare(strict_types=1);

namespace App\DataScraper;

final readonly class InfoType
{
    public function __construct(
        public string $identifier,
        public string $name,
        public string $description,
        public string $defaultPath,
        public string $defaultBranch,
        public string $defaultScraper,
    ) {
    }
}
