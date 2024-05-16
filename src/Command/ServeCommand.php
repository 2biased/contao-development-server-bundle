<?php

declare(strict_types=1);

/*
 * This file is part of Contao Development Server Bundle.
 *
 * @author 2biased <2biased@proton.me>
 *
 * @license LGPL-3.0-or-later
 */

namespace TwoBiased\ContaoDevelopmentServerBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;

class ServeCommand extends Command
{
    protected static $defaultName = 'serve';

    protected static $defaultDescription = 'Starts a development server';

    public function __construct(
        private readonly string $webDir,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addOption('host', null, InputOption::VALUE_OPTIONAL, 'Host', '127.0.0.1')
            ->addOption('port', null, InputOption::VALUE_OPTIONAL, 'Port', '8000')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $process = new Process([
            (new PhpExecutableFinder())->find(false),
            '-S',
            $input->getOption('host').':'.$input->getOption('port'),
            '-t',
            $this->webDir,
            __DIR__.'/../../server.php',
        ]);

        $process->run(
            static function ($type, $buffer): void {
                echo $buffer;
            }
        );

        return $process->isSuccessful() ? Command::SUCCESS : Command::FAILURE;
    }
}
