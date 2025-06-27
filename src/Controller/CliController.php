<?php

declare(strict_types=1);

namespace App\Controller;

use App\Command\CommandRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * CLI Controller.
 */
class CliController extends AbstractController
{
    private CommandRegistry $commandRegistry;

    public function __construct()
    {
        $this->commandRegistry = new CommandRegistry();
    }

    #[Route('/', name: 'app_cli')]
    public function index(): Response
    {
        return $this->render('cli/index.html.twig');
    }

    #[Route('/execute', name: 'cli_execute', methods: ['POST'])]
    public function execute(Request $request): Response
    {
        $input = (string) $request->request->get('command', '');
        $parts = explode(' ', $input);
        $commandName = $parts[0];
        $params = [];

        foreach (\array_slice($parts, 1) as $part) {
            if (str_contains($part, '=')) {
                [$key, $value] = explode('=', $part, 2);
                $params[$key] = $value;
            }
        }

        $command = $this->commandRegistry->getCommand($commandName);

        if ($command) {
            $context = $command->execute($params);
            $template = $command->getTemplate();
        } else {
            $context = ['command' => $input];
            $template = 'commands/not_found.html.twig';
        }

        return $this->render('cli/command_output.html.twig', [
            'input' => $input,
            'output' => $this->renderView($template, $context),
        ]);
    }
}
