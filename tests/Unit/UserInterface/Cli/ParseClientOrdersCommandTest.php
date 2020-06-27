<?php

declare(strict_types=1);
use App\Tests\Unit\Spy\MessageBus;
use App\UserInterface\Cli\ParseClientOrdersCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;

/**
 * @author Mateusz Kaczorowski <mateuszkaczorowski3@gmail.com>
 */
class ParseClientOrdersCommandTest extends TestCase
{
    /** @var ParseClientOrdersCommand */
    private $command;

    /** @var MessageBus */
    private $messageBus;

    protected function setUp(): void
    {
        $this->messageBus = new MessageBus();
        $this->command = new ParseClientOrdersCommand($this->messageBus);
    }

    public function testGetName(): void
    {
        $this->assertSame('app:parse-client-orders', $this->command->getName());
    }

    /**
     * @dataProvider invalidArgument
     */
    public function testThrowExceptionWhenArgumentIsInvalid($argument)
    {
        $commandTester = new CommandTester($this->command);

        $this->expectException(FileNotFoundException::class);
        $commandTester->execute(
            [
                '-f' => $argument,
            ]
        );
    }

    public function testExecute()
    {
        \fopen('testfile.txt', 'w');
        $commandTester = new CommandTester($this->command);

        $commandTester->execute(
            [
                '-f' => 'testfile.txt',
            ]
        );
        $message = $this->messageBus->dispatchedMessages;

        $this->assertFileEquals('testfile.txt', $message[0]->getFileName());
        $this->assertCount(1, $this->messageBus->dispatchedMessages);

        \unlink('testfile.txt');
    }

    public function invalidArgument(): array
    {
        return [
            ['asfdwefwef'],
            [['testfile.txt']],
            [123],
        ];
    }
}
