<?php

declare(strict_types=1);

namespace App\Controller;

use App\Configuration;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class TriggerScrapingController extends AbstractController
{
    private array $index = [];

    public function __construct(
        private HttpClientInterface $githubClient,
        private Configuration $configuration,
    ) {
    }

    #[Route('/trigger-scraping', methods: [Request::METHOD_POST])]
    public function __invoke(): Response
    {
        $data = $this->configuration->getServices();

        foreach ($data->services as $service) {
            foreach ($service->infoSources as $infoSource) {
                $path = $data->organisation->name . '/' . $service->name . '/' . $infoSource->branch . '/' . $infoSource->path;
                $response = $this->githubClient->request(
                    Request::METHOD_GET,
                    $path
                );
                $content = $response->getContent();
                $this->index[$path] = $content;
            }
        }

        return new Response();
    }
}
