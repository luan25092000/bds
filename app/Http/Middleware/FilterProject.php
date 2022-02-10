<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;
use Session;

class FilterProject
{
    private $session;

    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $projects = $this->getViewedProjects();

        if (!is_null($projects))
        {
            $projects = $this->cleanExpiredViews($projects);
            $this->storeProjects($projects);
        }

        return $next($request);
    }

    private function getViewedProjects()
    {
        return $this->session->get('viewed_projects', null);
    }

    private function cleanExpiredViews($projects)
    {
        $time = time();

        // Let the views expire after 30 seconds.
        $throttleTime = 30;

        return array_filter($projects, function ($timestamp) use ($time, $throttleTime)
        {
            return ($timestamp + $throttleTime) > $time;
        });
    }

    private function storeProjects($projects)
    {
        $this->session->put('viewed_projects', $projects);
    }
}
