<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class DataController extends AbstractController
{
    #[Route('/data', name: 'data')]
    public function __invoke(): Response
    {
        return new JsonResponse([
            'data' => [
                [
                    'type' => 'X',
                    'service' => 'Y',
                    'value' => 'Z',
                ],
                [
                    'type' => 'A',
                    'service' => 'B',
                    'value' => 'C',
                ],
            ]
        ]);
    }
}
