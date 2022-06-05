<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
    // 変数の中身はルートサービスプロバイダで設定した内容
    // 
    protected $user_route = 'user.login';
    protected $owner_route = 'owner.login';
    protected $admin_route = 'admin.login';

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            if(Route::is('owner.*')){
                return route($this->owner_route);
            } else if(Route::is('admin.*')){
                return route($this->admin_route);
            }else{
                return route($this->user_route);
            }
        }
    }
}
