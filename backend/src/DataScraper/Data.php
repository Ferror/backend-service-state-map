<?php

declare(strict_types=1);

namespace App\DataScraper;

final class Data
{
    public function __construct(
        public Organisation $organisation,
        public array $infoTypes,
        public array $services,
    )
    {
    }
}
