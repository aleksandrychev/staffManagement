<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 10.12.16
 * Time: 10:33
 */

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Response;

class ApiResponse
{
    public function handle($request, Closure $next)
    {
        /** @var Response $response */
        $response = $next($request);

        if($response->getStatusCode() == 200){
            $success = true;
        } else{
            $success = false;
        }
        $data = ['success' => $success, 'data' => json_decode($response->getContent())];
        $response->setContent(json_encode($data));
        return $response;
    }
}