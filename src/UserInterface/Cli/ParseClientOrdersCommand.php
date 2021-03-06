<?php

declare(strict_types=1);

namespace App\UserInterface\Cli;

use App\Application\Command\ParseOrdersFromXlsx;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Exception\FileNotFoundException;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * @author Mateusz Kaczorowski <mateuszkaczorowski3@gmail.com>
 */
class ParseClientOrdersCommand extends Command
{
    private MessageBusInterface $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        parent::__construct('app:parse-client-orders');
        $this->commandBus = $commandBus;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $fileName = $input->getOption('file-name');

        if (!$fileName) {
            $io = new SymfonyStyle($input, $output);
            $io->error('Parameter file-name (-f) is required');

            return Command::FAILURE;
        }

        if (!\is_string($fileName) || !\file_exists($fileName)) {
            throw new FileNotFoundException('File with the given name does not exist or has an incorrect name ');
        }

        $this->commandBus->dispatch(new ParseOrdersFromXlsx($fileName));

        return Command::SUCCESS;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Parse orders per client')
            ->addOption('file-name', 'f', InputOption::VALUE_REQUIRED, 'input file name')
        ;
    }
}
