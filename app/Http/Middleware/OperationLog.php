<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class OperationLog
{
    /**
     * 处理传入的请求
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $uri = $request->path();
        $input = $request->all();
        $method = $request->method();
        $ip = $request->getClientIp();
        $logMsg = join([$method . ' ' . $uri . ' ', json_encode($input), $ip], ' | ');

        Log::info($logMsg);

        return $next($request);
    }

}
