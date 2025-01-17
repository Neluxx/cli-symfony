<?php

namespace App\Command;

class DateCommand implements CommandInterface
{
    public function execute(array $params = []): array
    {
        return [
            'current_datetime' => new \DateTime(),
        ];
    }

    public function getTemplate(): string
    {
        return 'commands/date.html.twig';
    }
}