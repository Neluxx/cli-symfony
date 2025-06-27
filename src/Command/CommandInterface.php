<?php

declare(strict_types=1);

namespace App\Command;

interface CommandInterface
{
    /**
     * Executes the command and returns the context (data) for the template.
     *
     * @param array<string> $params Parameters for the command
     *
     * @return array<string, mixed> Context data for template rendering
     */
    public function execute(array $params = []): array;

    /**
     * Returns the path to the template.
     */
    public function getTemplate(): string;
}
