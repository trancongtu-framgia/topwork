<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Repositories\Interfaces\NotificationRepository;

class NotificationMiddleware
{
    private $notificationRepository;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            View::share('notifications', $this->notificationRepository->getLatestNotification(Auth::user()->token));
        }

        return $next($request);
    }
}
