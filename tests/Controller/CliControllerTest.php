<?php

namespace App\Tests\Controller;

use App\Kernel;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CliControllerTest extends WebTestCase
{
    protected static function getKernelClass(): string
    {
        return Kernel::class;
    }

    public function testIndexPageLoadsSuccessfully(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        self::assertResponseIsSuccessful();
        self::assertPageTitleContains('CLI');
    }

    public function testExecuteCommandNotFound(): void
    {
        $client = static::createClient();
        $client->request('POST', '/execute', [
            'command' => 'nonexistentcommand',
        ]);

        self::assertResponseIsSuccessful();
        self::assertSelectorExists('div.command-output');
        self::assertSelectorTextContains('div.command-output', 'Command not found');
    }

    public function testExecuteCommandSuccess(): void
    {
        $client = static::createClient();
        $client->request('POST', '/execute', [
            'command' => 'hello',
        ]);

        self::assertResponseIsSuccessful();
        self::assertSelectorExists('div.command-output');
        self::assertSelectorTextContains('div.command-output', 'Hello, World!');
    }
}
