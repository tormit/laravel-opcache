<?php

namespace Appstract\Opcache\Test;

use Artisan;
use Illuminate\Support\Facades\Http;

class CompileTest extends TestCase
{
    /** @test */
    public function optimizes()
    {
        Http::fake([
            '*' => $this->makeLocalRequest('compile'),
        ]);

        Artisan::call('opcache:compile --force', []);

        $output = Artisan::output();

        $this->assertStringContainsString('files compiled', $output);
    }
}
