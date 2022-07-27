<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use JWTAuth;
class GuardAssign extends BaseMiddleware
{
    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if($guard != null){
            auth()->shouldUse($guard); //shoud you user guard / table
            try {
//                  $user = $this->auth->authenticate($request);  //check authenticted user
             $user=JWTAuth::parseToken()->authenticate();
            } catch (JWTException $e) {
                return  $this -> returnError('444', 'يجب تسجيل الدخول اولا ');
            }

        }
        return $next($request);
    }


}
