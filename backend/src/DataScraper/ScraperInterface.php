<?php

declare(strict_types=1);

namespace App\DataScraper;

interface ScraperInterface
{
    public function scrape(string $fileContent): mixed;

    public function supports(string $path): bool;
}
