<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;

class CheckAdminToken
{
    use GeneralTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user=null;
        try { $user=JWTAuth::parseToken()->authenticate();

        }catch (\Exception $ex){
            if($ex instanceof TokenInvalidException){
                return $this->returnError('E001','InvalidToken');
            }
            elseif ($ex instanceof TokenExpiredException){
                return $this->returnError('E001','ExpiredToken');
            }
            else{
                return $this->returnError('E001','TokenNotFound');

            }
        }

        catch (\Throwable $ex){
            if($ex instanceof TokenInvalidException){
                return $this->returnError('E001','InvalidToken');
            }
            elseif ($ex instanceof TokenExpiredException){
                return $this->returnError('E001','ExpiredToken');
            }
            else{
                return $this->returnError('E001','TokenNotFound');

            }
        }
        if(!$user)
        {
            $this->returnError('E322','Unauthenticated.');
        }
        return $next($request);
    }
}
