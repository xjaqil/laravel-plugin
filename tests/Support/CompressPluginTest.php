<?php

namespace Aqil\LaravelPlugin\Tests\Support;

use Aqil\LaravelPlugin\Support\CompressPlugin;
use Aqil\LaravelPlugin\Support\Plugin;
use Aqil\LaravelPlugin\Tests\TestCase;

class CompressPluginTest extends TestCase
{
    private Plugin $plugin;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('plugin:make', ['name' => ['Blog']]);
        $this->plugin = $this->app['plugins.repository']->find('Blog');
    }

    public function tearDown(): void
    {
        $this->app['files']->delete([
            $this->plugin->getCompressFilePath(),
        ]);
        $this->plugin->delete();
        parent::tearDown();
    }

    public function test_it_can_compress_succeed()
    {
        $res = (new CompressPlugin($this->plugin))->handle();
        $this->assertFileExists($this->plugin->getCompressFilePath());
        $this->assertTrue($res);
    }
}
