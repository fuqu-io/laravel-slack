<?php

namespace Maknz\Slack\Laravel;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Maknz\Slack\Client;

class ServiceProvider extends BaseServiceProvider{
	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot(){
		$this->publishes([__DIR__ . '/../config/main.php' => config_path('slack.php')], 'config');
		$this->mergeConfigFrom(__DIR__ . '/../config/main.php', 'slack');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register(){

		$this->app->singleton('SlackAccount', function($app){
			return new Client(env('SLACK_HOOK_URL'), config('slack'));
		});

	}
}
