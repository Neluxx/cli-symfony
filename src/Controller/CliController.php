<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function execute(Request $request): Response
    {
        $input = $request->request->get('command', '');

        $commands = [
            'help' => "Available commands: help, hello, date, time\n",
            'hello' => "Hello, User!\n",
            'date' => "Current date and time: " . (new \DateTime())->format('Y-m-d H:i:s') . "\n",
            'time' => "Current time is: " . (new \DateTime())->format('H:i:s') . "\n",
        ];

        if (array_key_exists($input, $commands)) {
            $output = $commands[$input];
        } else {
            $output = "Command not found: $input \n";
        }

        return new Response($output);
    }
}
