<?php

namespace Appstract\Opcache\Test;

use Artisan;
use Illuminate\Support\Facades\Http;

class ClearTest extends TestCase
{
    /** @test */
    public function is_cleared(): void
    {
        Http::fake([
            '*' => $this->makeLocalRequest('clear'),
        ]);

        Artisan::call('opcache:clear', []);

        $output = Artisan::output();

        $this->assertStringContainsString('cleared', $output);
    }
}
