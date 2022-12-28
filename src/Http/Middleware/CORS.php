<?php

namespace Zdirnecamlcs96\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;

class CORS {
    /**
     * Handle an incoming request.
     * 
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */

    public function handle($request, Closure $next) {
        header('Access-Control-Allow-Origin: *');

        // Allow OPTIONS Method
        $headers = [
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization'
        ];

        if($request->getMethod() == "OPTIONS")
        {
            // The client-side application can set only headers allowed in Access-Control-Allow-Headers
            return Response::make('OK', 200, $headers);
        }

        $response = $next($request);

        foreach ($headers as $key => $value)
            $response->header($key, $value);
        
        return $response;
    }
}