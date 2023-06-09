<?php

declare(strict_types=1);

namespace App\DataScraper;

final readonly class InfoSource
{
    public function __construct(
        public string $path,
        public InfoType $infoType,
    ) {
    }
}
