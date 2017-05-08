<?php

namespace Salamium\Testinium;

use Nette\Http,
	Nette\Utils;

class FileUploadFactory
{

	/** @var string */
	private $source;

	public function __construct($source)
	{
		Utils\FileSystem::createDir($source);
		$this->source = $source;
	}

	/**
	 * @param string $name
	 * @param int $error
	 * @param string $tmpName - file name of file path
	 * @return Http\FileUpload
	 */
	public function create($name, $error = UPLOAD_ERR_OK, $tmpName = NULL)
	{
		if ($tmpName === NULL || !is_file($tmpName)) {
			if ($tmpName === NULL) {
				$tmpName = Utils\Random::generate();
			}

			if ($error === UPLOAD_ERR_OK) {
				$content = str_repeat('0', rand(10, 500));
				$tmpName = $this->source . DIRECTORY_SEPARATOR . $tmpName;
				file_put_contents($tmpName, $content);
			}
		}

		return new Http\FileUpload([
			'name' => $name,
			'type' => 'it does not matter',
			'size' => $error === UPLOAD_ERR_OK ? filesize($tmpName) : 0,
			'tmp_name' => $tmpName,
			'error' => $error
		]);
	}

}
