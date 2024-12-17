<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * CLI Controller
 */
class CliController extends AbstractController
{
    #[Route('/', name: 'app_cli')]
    public function index(): Response
    {
        return $this->render('cli/index.html.twig');
    }

    #[Route('/execute', name: 'cli_execute', methods: ['POST'])]
    public function execute(Request $request): JsonResponse
    {
        $command = $request->request->get('command');

        $output = match (strtolower($command)) {
            'help' => "Available commands:\n- help\n- hello\n- date",
            'hello' => "Hello, User!",
            'date' => "Current date and time: " . (new \DateTime())->format('Y-m-d H:i:s'),
            default => "Command not recognized. Type 'help' for a list of available commands.",
        };

        return new JsonResponse(['output' => $output]);
    }
}
