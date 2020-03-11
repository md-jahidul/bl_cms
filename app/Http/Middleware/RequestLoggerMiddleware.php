<?php

namespace App\Http\Middleware;

use App\Models\RequestLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RequestLoggerMiddleware
{

    protected $start_time;
    protected $end_time;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->start_time = round(microtime(true) * 1000);
        return $next($request);
    }

    /**
     * @param  Request  $request
     * @param  Response  $response
     */
    public function terminate(Request $request, Response $response)
    {
        $this->end_time = round(microtime(true) * 1000);
        RequestLog::create([
            'url'             => $request->fullUrl(),
            'request_method'  => $request->method(),
            'request_header'  => $request->header(),
            'request_body'    => $request->getContent(),
            'ip'              => $request->ip(),
            'start_time'      => $this->start_time,
            'end_time'        => $this->end_time,
            'response_time'   => ($this->end_time - $this->start_time),
            'status_code'     => $response->getStatusCode(),
            'response_body'   => $response->getContent()
        ]);
    }
}
