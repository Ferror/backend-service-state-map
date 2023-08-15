<?php

declare(strict_types=1);

namespace App\DataScraper;


readonly class PregMatchScraper implements ScraperInterface
{
    public function __construct(private string $match)
    {
    }

    public function scrape(string $fileContent): ?string
    {
        preg_match($this->match, $fileContent, $matches);

        return $matches[1] ?? null;
    }

    public function supports(string $path): bool
    {
        return str_contains($path, 'Dockerfile');
    }
}
