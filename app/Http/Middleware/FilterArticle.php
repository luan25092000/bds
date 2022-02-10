<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;
use Session;

class FilterArticle
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
        $articles = $this->getViewedArticles();

        if (!is_null($articles))
        {
            $articles = $this->cleanExpiredViews($articles);
            $this->storeArticles($articles);
        }

        return $next($request);
    }

    private function getViewedArticles()
    {
        return $this->session->get('viewed_articles', null);
    }

    private function cleanExpiredViews($articles)
    {
        $time = time();

        // Let the views expire after 30 seconds.
        $throttleTime = 30;

        return array_filter($articles, function ($timestamp) use ($time, $throttleTime)
        {
            return ($timestamp + $throttleTime) > $time;
        });
    }

    private function storeArticles($articles)
    {
        $this->session->put('viewed_articles', $articles);
    }
}
