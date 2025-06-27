<?php

declare(strict_types=1);

namespace App\Command;

class CommandRegistry
{
    /** @var array<CommandInterface> */
    private array $commands = [];

    public function __construct()
    {
        $this->register('help', new HelpCommand());
        $this->register('date', new DateCommand());
        $this->register('hello', new HelloCommand());
    }

    public function register(string $name, CommandInterface $command): void
    {
        $this->commands[$name] = $command;
    }

    public function getCommand(string $name): ?CommandInterface
    {
        return $this->commands[$name] ?? null;
    }
}
