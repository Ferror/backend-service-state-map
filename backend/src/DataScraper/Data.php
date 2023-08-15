<?php

declare(strict_types=1);

namespace App\DataScraper;

readonly final class Data
{
    /**
     * @param InfoType[] $infoTypes
     * @param Service[] $services
     */
    public function __construct(
        public array $infoTypes,
        public array $services,
    ) {
    }
}
