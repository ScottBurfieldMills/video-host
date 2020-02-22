<?php

namespace App\GraphQL\Middleware;

use Closure;
use DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class LogSqlQueries
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        DB::enableQueryLog();

        /** @var Response $response */
        $response = $next($request);

        if ($response instanceof JsonResponse) {
            $data = $response->getData(true);

            // add query log
            if (!Arr::has($data, '_meta')) $data['_meta'] = [];

             $data['_meta']['queries'] = DB::getQueryLog();

            $response->setData($data);
        }

        return $response;
    }
}
