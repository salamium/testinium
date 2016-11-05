<?php

if (!function_exists('dd')) {

	function dd($var /* ... */)
	{
		if (Tracy\Debugger::$productionMode) {
			return;
		}
		call_user_func_array('Tracy\Debugger::dump', func_get_args());
		exit;
	}

}

if (!function_exists('d')) {

	function d($var /* ... */)
	{
		call_user_func_array('Tracy\Debugger::dump', func_get_args());
	}

}
