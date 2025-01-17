<?php

namespace App\Command;

class HelpCommand implements CommandInterface
{
    public function execute(array $params = []): array
    {
        return [
            'commands' => ['help', 'hello', 'date', 'time'],
        ];
    }

    public function getTemplate(): string
    {
        return 'commands/help.html.twig';
    }
}