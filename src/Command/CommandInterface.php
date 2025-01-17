<?php

namespace App\Command;

interface CommandInterface
{
    /**
     * Executes the command and returns the context (data) for the template.
     *
     * @param array $params Parameters for the command
     * @return array Context data for template rendering
     */
    public function execute(array $params = []): array;

    /**
     * Returns the path to the template.
     *
     * @return string
     */
    public function getTemplate(): string;
}