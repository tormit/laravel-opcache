<?php

namespace Appstract\Opcache\Test;

use Artisan;
use Illuminate\Support\Facades\Http;

class CompileTest extends TestCase
{
    /** @test */
    public function optimizes(): void
    {
        Http::fake([
            '*' => $this->makeLocalRequest('compile', ['force' => true]),
        ]);

        Artisan::call('opcache:compile --force', []);

        $output = Artisan::output();

        $this->assertStringContainsString('files compiled', $output);
    }
}
