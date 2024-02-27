<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = Route::getFacadeRoot()->current()->uri();
        $route = explode('/',$routeName);
        $roleRoutes = Role::distinct()->whereNotNull('allowed_route')->pluck('allowed_route')->toArray();
        
        if(auth()->check()){
            if(!in_array($route[0] , $roleRoutes )){
                return $next($request);
            }else{
                if($route[0] != auth()->user()->roles[0]->allowed_route){
                    // $path = $route[0] == auth()->user()->roles[0]->allowed_route ? $route[0].'.login' : '' . auth()->user()->roles[0]->allowed_route . '.index' ;
                    $path = $route[0] == auth()->user()->roles[0]->allowed_route ? $route[0].'.login' : 'frontend' . '.index' ;
                    return redirect()->route($path);
                }else{
                    return $next($request);
                }
            }
        }else{
            $routeDestination = in_array($route[0] , $roleRoutes) ? $route[0]. '.login' : 'login';
            $path = $route[0] != '' ? $routeDestination : auth()->roles[0]->allowed_route.'.index';
            return redirect()->route($path);
        }
    }
}


// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Illuminate\Http\Request  $request
//      * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
//      * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
//      */
//     public function handle(Request $request, Closure $next)
//     {
//         //get the current url route in the browser
//         $routeName =url()->current();

//         //split route url by / and save them as array 
//         $route = explode('/', $routeName);

//         //get allowed_route field from db and distinct the values then save them as an array
//         //ex: $roleRoutes = ['admin',null];
//         $roleRoutes = Role::distinct()->whereNotNull('allowed_route')->pluck('allowed_route')->toArray();

//         //if user loged in correctly 
//         if(auth()->check()){
//             // if $route[3] part is not one of the words in the array $roleRoutes
//             if(!in_array($route[3],$roleRoutes)){
//                 // open next request because the request is not for admin its for all
//                 return $next($request);
//             }else{
//                 // if $route[3] part is  one of the words in the array $roleRoutes which come from database 
//                 //but this word not admin (auth()->user()->roles[0]->allowed_route return admin )
//                 if($route[3] != auth()->user()->roles[0]->allowed_route){
//                     $path = $route[3] == auth()->user()->roles[0]->allowed_route ? $route[3]. '.login' : ''. auth()->user()->roles[0]->allowed_route. 'frontend.index';
//                     return redirect()->route($path);
//                 }else{
//                     // the correct access
//                     return $next($request);
//                 }
//         }

//         }else{
//             //if user does not loged correctly (no auth yet)
//             /* url admin/anypage 
//             * - if $route[3] which is url link part one  = admin equal to $roleRoutes which is in the database allowed
//             * - then route this url to admin/login --> related to admin
//             * - else route this url to login -->related to users
//             */
//             $routeDestination = in_array($route[3], $roleRoutes) ? $route[3] . '.login' : 'login';
//             $path = $route[3] != '' ? $routeDestination : auth()->user()->roles[0]->allowed_route . '.index';
//             return redirect()->route($path);
//         }

//     }
// }


