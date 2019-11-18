<?php

namespace App\Http\Middleware;

use Closure;
use App\Role;
use Illuminate\Support\Facades\Auth;


class CheckRole
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
        $roles = array_slice(func_get_args(), 2);

        foreach ($roles as $role) {

            try {

                Role::whereUsername($role)->firstOrFail();

                if (Auth::user()->hasRole($role)) {
                    return $next($request);
                }

            } catch (ModelNotFoundException $exception) {

                dd('Could not find role ' . $role);

            }
        }

        return redirect('/posts')->with('error', 'You are not authorized to view that content.');

        /* if($request->user() === null){
            return abort(403);
        }
        if($request->user()->hasRole($role)){
            return $next($request);
        }
        return abort(401); */
    }
}
