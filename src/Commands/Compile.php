<?php

namespace Appstract\Opcache\Commands;

use Appstract\Opcache\CreatesRequest;
use Illuminate\Console\Command;

class Compile extends Command
{
    use CreatesRequest;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'opcache:compile {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pre-compile your application code';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->line('Compiling scripts...');

        $response = $this->sendRequest('compile', ['force' => $this->option('force') ?? false]);

        if (!$response->ok()) {
            $this->error('OPcache not configured');

            return 2;
        }

        $json = (array)($response->json()['result'] ?? []);

        if (array_key_exists('message', $json)) {
            $this->warn($response['result']['message']);

            return 1;
        }

        $this->info(sprintf('%s of %s files compiled', $response['result']['compiled_count'], $response['result']['total_files_count']));

        return 0;
    }
}
