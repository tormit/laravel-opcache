<?php

namespace Appstract\Opcache;

use Exception;
use Symfony\Component\Finder\Finder;

/**
 * Class OpcacheClass.
 */
class OpcacheClass
{
    /**
     * Clear OPcache.
     */
    public function clear(): bool
    {
        if (function_exists('opcache_reset')) {
            return opcache_reset();
        }

        return false;
    }

    /**
     * Get configuration values.
     */
    public function getConfig(): ?array
    {
        if (function_exists('opcache_get_configuration')) {
            return opcache_get_configuration();
        }

        return null;
    }

    /**
     * Get status info.
     */
    public function getStatus(): ?array
    {
        if (function_exists('opcache_get_status')) {
            return opcache_get_status(false);
        }

        return null;
    }

    /**
     * Pre-compile php scripts.
     *
     * @param bool $force
     *
     * @return array|null
     */
    public function compile(bool $force = false): ?array
    {
        if (!ini_get('opcache.dups_fix') && !$force) {
            return ['message' => 'opcache.dups_fix must be enabled, or run with --force'];
        }

        if (!function_exists('opcache_compile_file')) {
            return null;
        }

        $compiled = 0;

        // Get files in these paths
        $files = collect(Finder::create()->in(config('opcache.directories'))
            ->name('*.php')
            ->ignoreUnreadableDirs()
            ->notContains('#!/usr/bin/env php')
            ->exclude(config('opcache.exclude'))
            ->files()
            ->followLinks());

        // optimized files
        $files->each(function ($file) use (&$compiled) {
            try {
                if (!opcache_is_script_cached($file)) {
                    opcache_compile_file($file);
                }

                $compiled++;
            } catch (Exception $e) {
            }
        });

        return [
            'total_files_count' => $files->count(),
            'compiled_count'    => $compiled,
        ];
    }
}
