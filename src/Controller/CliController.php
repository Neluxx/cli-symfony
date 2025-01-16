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
            'help' => 'commands/help.html.twig',
            'hello' => 'commands/hello.html.twig',
            'date' => 'commands/date.html.twig',
            'time' => 'commands/time.html.twig',
        ];

        if (array_key_exists($input, $commands)) {
            return $this->render($commands[$input], [
                'current_datetime' => new \DateTime(),
            ]);
        }

        return $this->render('commands/not_found.html.twig', [
            'command' => $input,
        ]);
    }
}