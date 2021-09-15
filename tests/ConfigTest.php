<?php

namespace Appstract\Opcache\Test;

use Artisan;
use Illuminate\Support\Facades\Http;

class ConfigTest extends TestCase
{
    /** @test */
    public function shows_config(): void
    {
        Http::fake([
            '*' => $this->makeLocalRequest('config'),
        ]);

        Artisan::call('opcache:config', []);

        $output = Artisan::output();

        $this->assertStringContainsString('Version info', $output);
        $this->assertStringContainsString('Configuration info', $output);
    }
}
