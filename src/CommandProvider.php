<?php

namespace PHPSandbox\Try;

use Composer\Plugin\Capability\CommandProvider as CommandProviderCapability;
use PHPSandbox\Try\Command\TryCommand;

class CommandProvider implements CommandProviderCapability
{
    public function getCommands()
    {
        return [new TryCommand()];
    }
}
