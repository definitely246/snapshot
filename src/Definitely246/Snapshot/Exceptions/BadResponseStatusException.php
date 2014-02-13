<?php namespace Definitely246\Snapshot\Exceptions;

class BadResponseStatusException extends \Exception
{
	private $response;

	public function __construct($message, $response)
	{
		parent::__construct($message);
		$this->response = $response;
	}

	public function getResponse()
	{
		return $this->response;
	}
}