<?php

declare(strict_types=1);

namespace App\Command;

use DateTime;

class DateCommand implements CommandInterface
{
    public function execute(array $params = []): array
    {
        return [
            'current_datetime' => new DateTime(),
        ];
    }

    public function getTemplate(): string
    {
        return 'commands/date.html.twig';
    }
}
