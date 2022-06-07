<?php

namespace Aqil\LaravelPlugin\Providers;

use Carbon\Laravel\ServiceProvider;
use Illuminate\Support\Str;
use Aqil\LaravelPlugin\Console\Commands\ComposerInstallCommand;
use Aqil\LaravelPlugin\Console\Commands\ComposerRemoveCommand;
use Aqil\LaravelPlugin\Console\Commands\ComposerRequireCommand;
use Aqil\LaravelPlugin\Console\Commands\ControllerMakeCommand;
use Aqil\LaravelPlugin\Console\Commands\DisableCommand;
use Aqil\LaravelPlugin\Console\Commands\DownLoadCommand;
use Aqil\LaravelPlugin\Console\Commands\EnableCommand;
use Aqil\LaravelPlugin\Console\Commands\InstallCommand;
use Aqil\LaravelPlugin\Console\Commands\ListCommand;
use Aqil\LaravelPlugin\Console\Commands\LoginCommand;
use Aqil\LaravelPlugin\Console\Commands\MigrateCommand;
use Aqil\LaravelPlugin\Console\Commands\MigrationMakeCommand;
use Aqil\LaravelPlugin\Console\Commands\ModelMakeCommand;
use Aqil\LaravelPlugin\Console\Commands\PluginCommand;
use Aqil\LaravelPlugin\Console\Commands\PluginDeleteCommand;
use Aqil\LaravelPlugin\Console\Commands\PluginMakeCommand;
use Aqil\LaravelPlugin\Console\Commands\ProviderMakeCommand;
use Aqil\LaravelPlugin\Console\Commands\PublishCommand;
use Aqil\LaravelPlugin\Console\Commands\RegisterCommand;
use Aqil\LaravelPlugin\Console\Commands\RouteProviderMakeCommand;
use Aqil\LaravelPlugin\Console\Commands\SeedMakeCommand;
use Aqil\LaravelPlugin\Console\Commands\UploadCommand;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * Namespace of the console commands.
     *
     * @var string
     */
    protected string $consoleNamespace = 'Aqil\\LaravelPlugin\\Console\\Commands';

    /**
     * The available commands.
     *
     * @var array
     */
    protected array $commands = [
        PluginCommand::class,
        PluginMakeCommand::class,
        ProviderMakeCommand::class,
        RouteProviderMakeCommand::class,
        ControllerMakeCommand::class,
        ModelMakeCommand::class,
        MigrationMakeCommand::class,
        MigrateCommand::class,
        SeedMakeCommand::class,
        ComposerRequireCommand::class,
        ComposerRemoveCommand::class,
        ComposerInstallCommand::class,
        ListCommand::class,
        DisableCommand::class,
        EnableCommand::class,
        PluginDeleteCommand::class,
        InstallCommand::class,
        PublishCommand::class,
        RegisterCommand::class,
        LoginCommand::class,
        UploadCommand::class,
        DownLoadCommand::class,

    ];

    /**
     * @return array
     */
    private function resolveCommands(): array
    {
        $commands = [];

        foreach ((config('plugins.commands') ?: $this->commands) as $command) {
            $commands[] = Str::contains($command, $this->consoleNamespace) ?
                $command :
                $this->consoleNamespace.'\\'.$command;
        }

        return $commands;
    }

    public function register(): void
    {
        $this->commands($this->resolveCommands());
    }

    /**
     * @return array
     */
    public function provides(): array
    {
        return $this->commands;
    }
}
