<?php

namespace Aqil\LaravelPlugin\Listeners;

use Illuminate\Support\Facades\Artisan;
use Aqil\LaravelPlugin\Support\Plugin;

class PluginPublish
{
    public function handle(Plugin $plugin)
    {
        Artisan::call('plugin:publish', ['plugin' => $plugin->getName()]);
    }
}
