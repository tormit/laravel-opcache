<?php

namespace Appstract\Opcache\Test;

use Artisan;
use Illuminate\Support\Facades\Http;

class StatusTest extends TestCase
{
    /** @test */
    public function shows_status(): void
    {
        Http::fake([
            '*' => $this->makeLocalRequest('status'),
        ]);

        Artisan::call('opcache:status', []);

        $output = Artisan::output();

        $this->assertStringContainsString('Memory usage:', $output);
        $this->assertStringContainsString('Interned strings usage:', $output);
        $this->assertStringContainsString('Statistics:', $output);
    }
}
