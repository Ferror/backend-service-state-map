<?php

declare(strict_types=1);

namespace App\DataScraper;

class SymfonyVersionScraper implements ScraperInterface
{
    public function scrape(string $fileContent): ?string
    {
        $file = json_decode($fileContent, false, 512, JSON_THROW_ON_ERROR);

        return $file->extra->symfony->require ?? null;
    }

    public function supports(string $path): bool
    {
        return str_contains($path, 'composer.json');
    }
}
