<?php

declare(strict_types=1);

namespace App\DataScraper;

readonly final class Data
{
    /**
     * @param Organisation $organisation
     * @param InfoType[] $infoTypes
     * @param Service[] $services
     */
    public function __construct(
        public Organisation $organisation,
        public array $infoTypes,
        public array $services,
    ) {
    }
}
