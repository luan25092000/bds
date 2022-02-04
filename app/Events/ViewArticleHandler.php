<?php

namespace App\Events;

use Illuminate\Session\Store;

class ViewArticleHandler
{
    private $session;

	public function __construct(Store $session)
	{
		$this->session = $session;
	}
	public function handle($article)
	{

		if (!$this->isArticleViewed($article)) {
			$article->increment('view');
			$this->storeArticle($article);
		}
	}
	private function isArticleViewed($article)
	{
		$viewed = $this->session->get('viewed_articles', []);

		return array_key_exists($article->id, $viewed);
	}

	private function storeArticle($article)
	{
		$key = 'viewed_articles.' . $article->id;
		$this->session->put($key, time());
	}
}
