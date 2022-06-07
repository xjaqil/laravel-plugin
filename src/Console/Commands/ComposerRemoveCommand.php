<?php

namespace Aqil\LaravelPlugin\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Symfony\Component\Console\Input\InputArgument;
use Aqil\LaravelPlugin\Support\Composer\ComposerRemove;
use Aqil\LaravelPlugin\Traits\PluginCommandTrait;
use Aqil\LaravelPlugin\ValueObjects\ValRequire;
use Aqil\LaravelPlugin\ValueObjects\ValRequires;

class ComposerRemoveCommand extends Command
{
    use PluginCommandTrait;
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'plugin:composer-remove';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove the plugin composer package.';

    public function handle(): void
    {
        $packages = $this->argument('packages');
        $plugin = $this->argument('plugin');
        $pluginJson = $this->getPlugin()->json();

        try {
            $vrs = ValRequires::make();
            foreach ($packages as $package) {
                $vrs->append(ValRequire::make($package));
            }
            ComposerRemove::make()->appendRemovePluginRequires($plugin, $vrs)->run();
            $composer = $pluginJson->get('composer');

            foreach ($packages as $package) {
                Arr::forget($composer, "require.$package");
                Arr::forget($composer, "require-dev.$package");
            }

            $pluginJson->set('composer', $composer)->save();
            $this->info("Package {$vrs}remove complete.");
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }

    protected function getArguments(): array
    {
        return [
            ['plugin', InputArgument::REQUIRED, 'The name of plugins will be used.'],
            ['packages', InputArgument::IS_ARRAY, 'The name of the composer package name.'],
        ];
    }
}
