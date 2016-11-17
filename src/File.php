<?php

namespace Salamium\Testinium;

class File
{

	private static $root;

	public static function setRoot($path)
	{
		self::$root = $path;
	}

	public static function load($file)
	{
		return file_get_contents(self::createPath($file));
	}

	public static function save($name, $content)
	{
		file_put_contents(self::createPath($name), $content);
	}

	private static function createPath($file)
	{
		return self::$root . DIRECTORY_SEPARATOR . $file;
	}

}
