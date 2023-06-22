<?php

declare(strict_types=1);

namespace App\DataScraper;

interface ScraperInterface
{
    public function scrape(string $fileContent);
    public function getFileType(): InfoSource;
    public function getInfoType(): InfoType;
}
