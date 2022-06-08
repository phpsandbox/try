<?php

namespace PHPSandbox\Try;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\Capable;
use Composer\Plugin\PluginInterface;

class Plugin implements Capable, PluginInterface
{
    public function activate(Composer $composer, IOInterface $io): void
    {
        $io->info('Activated');
    }

    public function getCapabilities()
    {
        return [
            'Composer\Plugin\Capability\CommandProvider' => 'PHPSandbox\Try\CommandProvider',
        ];
    }

    public function deactivate(Composer $composer, IOInterface $io): void
    {
        // TODO: Implement deactivate() method.
    }

    public function uninstall(Composer $composer, IOInterface $io): void
    {
        // TODO: Implement uninstall() method.
    }
}
