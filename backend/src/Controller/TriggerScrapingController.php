<?php

declare(strict_types=1);

namespace App\Controller;

use App\Configuration;
use App\DataScraper\PregMatchScraper;
use App\DataScraper\ScraperInterface;
use App\DataScraper\SymfonyVersionScraper;
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
        private HttpClientInterface $githubClient,
        private Configuration $configuration,
    ) {
    }

    #[Route('/trigger-scraping', methods: [Request::METHOD_POST])]
    public function __invoke(): Response
    {
        $data = $this->configuration->getServices();

        // Fetch Content
        foreach ($data->services as $service) {
            foreach ($service->infoSources as $infoSource) {
                $path = $data->organisation->name . '/' . $service->name . '/' . $infoSource->branch . '/' . $infoSource->path;
                $response = $this->githubClient->request(
                    Request::METHOD_GET,
                    $path
                );
                $content = $response->getContent();
                $this->index[$service->name][$infoSource->path] = $content;
                $this->scrapers[$service->name][$infoSource->path][] = new PregMatchScraper($infoSource->scraper);
                $this->scrapers[$service->name][$infoSource->path][] = new SymfonyVersionScraper();
            }
        }

        // execute scrapers
        foreach ($data->services as $service) {
            foreach ($service->infoSources as $infoSource) {

                foreach ($this->scrapers[$service->name][$infoSource->path] as $scraper) {
                    if ($scraper->supports($infoSource->path)) {
                        $value = $scraper->scrape($this->index[$service->name][$infoSource->path]);
                        if ($value) {
                            $this->scraped[$service->name][$infoSource->path] = $value;
                        }
                    }
                }
            }
        }

        return new JsonResponse($this->scraped);
    }
}
