<?php

declare(strict_types=1);

namespace App\Controller;

use App\Configuration;
use App\DataScraper\PregMatchScraper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class TriggerScrapingController extends AbstractController
{
    private array $index = [];
    private array $scraped = [];
    private array $scrapers = [];

    public function __construct(
        private readonly HttpClientInterface $githubClient,
        private readonly Configuration $configuration,
    ) {
    }

    #[Route('/trigger-scraping', methods: [Request::METHOD_POST])]
    public function __invoke(): Response
    {
        $data = $this->configuration->getServices();

        // Fetch Content
        foreach ($data->services as $service) {
            foreach ($service->infoSources as $infoSource) {
                $path = $service->organisation . '/' . $service->name . '/' . $infoSource->branch . '/' . $infoSource->path;
                $response = $this->githubClient->request(
                    Request::METHOD_GET,
                    $path,
                );
                $content = $response->getContent();
                $this->index[$service->name][$infoSource->path] = $content;
            }
        }

        // Register Scrapers
        foreach ($data->services as $service) {
            foreach ($service->infoSources as $infoSource) {
                if ($infoSource->scraper) {
                    $this->scrapers[$service->name][$infoSource->infoTypeId][] = new PregMatchScraper($infoSource->scraper);
                }
            }
        }

        // Execute Scrapers
        foreach ($data->services as $service) {
            foreach ($service->infoSources as $infoSource) {
                foreach ($this->scrapers[$service->name][$infoSource->infoTypeId] as $scraper) {
                    if ($scraper->supports($infoSource->path)) {
                        $value = $scraper->scrape($this->index[$service->name][$infoSource->path]);
                        if ($value) {
                            $this->scraped[$service->name][$infoSource->infoTypeId] = $value;
                        }
                    }
                }
            }
        }

        return new JsonResponse($this->scraped);
    }
}
