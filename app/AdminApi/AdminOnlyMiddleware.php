<?php

namespace App\AdminApi;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

/**
 * Class AdminOnlyMiddleware
 * @package App\AdminApi
 */
class AdminOnlyMiddleware
{
    /**
     * @var Guard
     */
    protected $guard;

    /**
     * AdminOnlyMiddleware constructor.
     * @param Guard $guard
     */
    public function __construct(Guard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     * @throws AdminOnlyException
     */
    public function handle(Request $request, \Closure $next)
    {
        if ( ! $this->guard->user())
        {
            throw new AdminOnlyException();
        }

        if ( ! in_array($this->guard->user()->email, config('admin.accounts')))
        {
            throw new AdminOnlyException();
        }

        return $next($request);
    }
}
