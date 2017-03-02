<?php

namespace App\Http\Middleware;

use Closure;
use App\Domain\Services\UsersService;

class Authenticate
{
    /**
     * @var UsersService
     */
    private $service;

    /**
     * Authenticate constructor.
     * @param UsersService $service
     */
    public function __construct(UsersService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $id = $request->session()->get('id');
        if ($id && $user = $this->service->get($id)) {
            $request->setUserResolver(function () use ($user) {
                return $user;
            });

            return $next($request);
        }

        return redirect()->route('login');
    }
}
