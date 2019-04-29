<?php
namespace App\Http\Middleware;
use Closure;

class Cors
{
    /**
    * Handle an incoming request.
    *
    * @param \Illuminate\Http\Request $request
    * @param \Closure $next
    * @return mixed
    */
    public function handle($request, Closure $next )
    {
        header("Access-Controle-Allow-Origin: *");
        $headers = [
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, PATCH, DELETE, OPTIONS',
            'Access-Control-Allow-Headers' => 'x-requested-with, Content-Type, Origin, Authorization, Accept, Client-Security-Token',
        ];

        if($request->getMethod() == "OPTIONS"){
            return response() -> json('ok', 200,  $headers);
        }

        $response = $next($request);
        foreach($headers as $key => $value){
            $response->header($key,$value);
        }
        return $response;
     }
 }
