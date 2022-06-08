<?php

namespace PHPSandbox\Try\Command;

use Composer\Command\BaseCommand;
use Composer\Semver\Constraint\MatchAllConstraint;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TryCommand extends BaseCommand
{
    protected function configure(): void
    {
        $this
            ->setName('try')
            ->setDescription('Try a package on PHPSandbox')
            ->setDefinition([new InputArgument('package', InputArgument::REQUIRED, 'The package to be tried')]);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $packageName = $input->getArgument('package');
        $io = $this->getIO();

        $composer = $this->requireComposer();
        if (! $package = $composer->getRepositoryManager()->findPackage($packageName, new MatchAllConstraint())) {
            $io->error("Unable to find package '$packageName'!");

            return Command::FAILURE;
        }

        $url = 'https://play.phpsandbox.io/' . $package->getName();
        $io->write("Opening $url", true);
        shell_exec(sprintf('%s %s', $this->browserCommand(), $url));

        return 0;
    }

    /**
     * Retrieves the browser command based on the OS
     *
     * @return string
     */
    public function browserCommand(): string
    {
        switch (PHP_OS) {
            case 'Darwin':
                return 'open';
                break;
            case 'WINNT':
                return 'start';
                break;
            default:
                return 'xdg-open';
        }
    }
}
