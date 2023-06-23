<?php

declare(strict_types=1);

namespace App\DataScraper;

final class Organisation
{
    public function __construct(
        public string $token,
        public string $name,
    )
    {
    }
}
