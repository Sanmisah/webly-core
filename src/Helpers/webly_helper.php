<?php
if (! function_exists('website_title'))
{
	function website_title(): string
	{
		return service('settings')->get('App.website_title');
	}
}


if (! function_exists('template_info'))
{
	function template_info($field = null)
	{
		$path = config('Paths')->viewDirectory . '/' .  service('settings')->get('App.template') . 'template.json';
		$templateInfo = json_decode(file_get_contents($path), true)[0];
		return dot_array_search($field, $templateInfo);
	}
}
