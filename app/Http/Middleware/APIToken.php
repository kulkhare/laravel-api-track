<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\ApiRequestLog;
use Auth;

class APIToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if($request->header('Authorization') && User::where('api_token', $request->header('Authorization'))->first()){
            return $next($request);
        }
        return response()->json([
            'message' => 'Unauthenticated.',
        ]);
    }

    public function terminate($request, $response){
        $user = User::where('api_token', $request->header('Authorization'))->first();
        if($user){
            $log = ApiRequestLog::create([
                'requester'    => $user->id,
                'url'          => $request->fullUrl(),
                'method'       => $request->getMethod(),
                'ip_address'   => $request->getClientIp(),
                'status_code'  => $response->getStatusCode()
            ]);
        }
    }
}
