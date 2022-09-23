<?php
if (! function_exists('setting'))
{
	function setting($setting)
	{
		return service('settings')->get($setting);
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

if (! function_exists('block'))
{
	function block($block)
	{
		$Blocks = new Webly\Core\Models\Blocks();
        $block = $Blocks->where('block', $block)->first();
		return $block->description;
	}
}

if (! function_exists('validation_error'))
{
	function validation_error($field)
	{
		$validation =  \Config\Services::validation();
		return $validation->getError($field);
	}
}
