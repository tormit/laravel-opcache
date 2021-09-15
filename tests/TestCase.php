<?php

namespace Appstract\Opcache\Test;

use Appstract\Opcache\OpcacheServiceProvider;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.url', 'http://laravel7.test/');
        $app['config']->set('opcache.url', 'http://laravel7.test/');
        $app['config']->set('app.key', 'base64:Ed0VpanUWokW8AgY8jRCU8A5Cn3ou+uby8qLCQysUpg=');
        $app['config']->set('opcache.directories', __DIR__ . '/Stubs/');
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [OpcacheServiceProvider::class];
    }

    /**
     * Make a local request and return an Http faker response
     *
     * @param string $command
     * @param array  $parameters
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     * @see https://laravel.com/docs/8.x/http-client#faking-specific-urls
     */
    protected function makeLocalRequest(string $command, array $parameters = []): \GuzzleHttp\Promise\PromiseInterface
    {
        $response = $this->get("/opcache-api/$command?key=eyJpdiI6IjFsTC90eExyNG94clBhSVNROGVjOWc9PSIsInZhbHVlIjoieGRVUldyVGtCTG1jUDJ1VW9sQVhIZz09IiwibWFjIjoiNmEwZTcyOWQ4MzllYjA5ZjU2OTdhYWVjYzFhODkwZGQ0YjI5ZjQxMTgxODVhODM2MGUzNjdlY2FhNTg0YTE3YiJ9&" . http_build_query($parameters));

        return Http::response($response->content(), $response->getStatusCode());
    }
}
