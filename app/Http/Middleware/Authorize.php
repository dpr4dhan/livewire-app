<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Authorize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $permission)
    {
        $permissions = explode('|', $permission);
        $canDo = false;
        foreach($permissions as $per)
        {
             $canDo = auth()->user()->hasPermission($per);
        }
        if($canDo){
            return $next($request);
        }else{
            session()->flash('error', "You don't have required permission");
            return redirect()->route('dashboard');
        }
    }
}
