<?php

namespace App\Events;

use Illuminate\Session\Store;

class ViewProjectHandler
{
    private $session;

	public function __construct(Store $session)
	{
		$this->session = $session;
	}
	public function handle($project)
	{

		if (!$this->isProjectViewed($project)) {
			$project->increment('view');
			$this->storeProject($project);
		}
	}
	private function isProjectViewed($project)
	{
		$viewed = $this->session->get('viewed_projects', []);

		return array_key_exists($project->id, $viewed);
	}

	private function storeProject($project)
	{
		$key = 'viewed_projects.' . $project->id;
		$this->session->put($key, time());
	}
}
