<?php

namespace Appstract\Opcache\Http\Controllers;

use Appstract\Opcache\OpcacheFacade as OPcache;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

/**
 * Class OpcacheController.
 */
class OpcacheController extends BaseController
{
    /**
     * Clear the OPcache.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clear(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['result' => OPcache::clear()]);
    }

    /**
     * Get config values.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function config(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['result' => OPcache::getConfig()]);
    }

    /**
     * Get status info.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function status(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['result' => OPcache::getStatus()]);
    }

    /**
     * Compile.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function compile(Request $request): \Illuminate\Http\JsonResponse
    {
        return response()->json(['result' => OPcache::compile($request->get('force'))]);
    }
}
