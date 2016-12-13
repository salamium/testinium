<?php

function dd($var /* ... */)
{
	call_user_func_array('d', func_get_args());
	exit;
}

function d($var /* ... */)
{
	foreach (func_get_args() as $v) {
		Tracy\Debugger::dump($v);
	}
}
