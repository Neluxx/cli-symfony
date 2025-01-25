<?php

namespace App\Tests\Command;

use App\Command\CommandRegistry;
use App\Command\DateCommand;
use App\Command\HelloCommand;
use App\Command\HelpCommand;
use PHPUnit\Framework\TestCase;

class CommandRegistryTest extends TestCase
{
    /**
     * Test that the constructor properly registers default commands.
     */
    public function testConstructorRegistersDefaultCommands(): void
    {
        $registry = new CommandRegistry();

        $this->assertInstanceOf(HelpCommand::class, $registry->getCommand('help'));
        $this->assertInstanceOf(DateCommand::class, $registry->getCommand('date'));
        $this->assertInstanceOf(HelloCommand::class, $registry->getCommand('hello'));
    }

    /**
     * Test that commands can be retrieved by their name.
     */
    public function testGetCommandReturnsRegisteredCommand(): void
    {
        $registry = new CommandRegistry();

        $this->assertNotNull($registry->getCommand('help'));
        $this->assertNotNull($registry->getCommand('date'));
        $this->assertNotNull($registry->getCommand('hello'));
    }

    /**
     * Test that getCommand returns null for an unregistered command.
     */
    public function testGetCommandReturnsNullForUnregisteredCommand(): void
    {
        $registry = new CommandRegistry();

        $this->assertNull($registry->getCommand('invalid_command'));
    }
}
