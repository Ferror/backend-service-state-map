<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class TriggerScrapingController extends AbstractController
{
    public function __construct(
        private HttpClientInterface $githubClient,
    ) {
    }

    #[Route('/trigger-scraping', methods: [Request::METHOD_POST])]
    public function __invoke(): Response
    {
        // TEMP make it sync
        $response = $this->githubClient->request(Request::METHOD_GET, '/organisation/service-name/master/file/path/composer.json');
        $content = $response->getContent();

        dd($content);

        return new Response();
    }
}
