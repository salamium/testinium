<?php

namespace Salamium\Testinium;

use Nette\Http;

class HttpRequestFactory
{

	/** @var string */
	private $host;

	/** @var array|NULL */
	private $post;

	/** @var array|NULL */
	private $files;

	/** @var array|NULL */
	private $cookie;

	/** @var array|NULL */
	private $headers;

	/** @var string|NULL */
	private $method;

	/** @var string|NULL */
	private $remoteAddress;

	/** @var string|NULL */
	private $remoteHost;

	public function __construct()
	{
		$this->reset();
	}

	public function setHost($host)
	{
		if (!self::checkHost($host)) {
			throw new \InvalidArgumentException('Host must start with double slash or http.');
		}
		$this->host = $host;
		return $this;
	}

	public function setPost(array $post)
	{
		$this->post = $post;
		return $this;
	}

	public function setFiles(array $files)
	{
		$this->files = $files;
		return $this;
	}

	public function setCookie(array $cookie)
	{
		$this->cookie = $cookie;
		return $this;
	}

	public function setHeaders(array $headers)
	{
		$this->headers = $headers;
		return $this;
	}

	public function setMethod($method)
	{
		$this->method = $method;
		return $this;
	}

	public function setRemoteAddress($remoteAddress)
	{
		$this->remoteAddress = $remoteAddress;
		return $this;
	}

	public function setRemoteHost($remoteHost)
	{
		$this->remoteHost = $remoteHost;
		return $this;
	}

	/** @return Http\Request */
	public function create($url, array $query = NULL)
	{
		if (!self::checkHost($url)) {
			$url = $this->host . '/' . ltrim($url, '/');
		}

		$request = new Http\Request(new Http\UrlScript($url), $query, $this->post, $this->files, $this->cookie, $this->headers, $this->method);
		$this->reset();
		return $request;
	}

	protected function reset()
	{
		$this->cookie = $this->files = $this->headers = $this->post = NULL;
		$this->host = '//www.example.com';
		$this->remoteAddress = '19.86.30.12';
		$this->remoteHost = '1.server';
		$this->method = Http\IRequest::GET;
	}

	private static function checkHost($host)
	{
		return preg_match('/^\/\/|http/', $host);
	}

}
