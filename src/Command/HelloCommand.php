<?php

namespace App\Command;

class HelloCommand implements CommandInterface
{
    public function execute(array $params = []): array
    {
        $name = $params['name'] ?? 'World';

        return [
            'name' => $name,
        ];
    }

    public function getTemplate(): string
    {
        return 'commands/hello.html.twig';
    }
}
