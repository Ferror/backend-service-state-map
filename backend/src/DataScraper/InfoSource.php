<?php

declare(strict_types=1);

namespace App\DataScraper;

final readonly class InfoSource
{
    public function __construct(
        public string $path,
        public string $branch,
        public string $scraper,
        public string $infoTypeId,
    ) {
    }
}
