<?php namespace Definitely246\Snapshot;

class PdfSnapshot
{
	/**
	 * Location of the phantomjs executable
	 */
	private $engine;

	/**
	 * Place to store script files while running with phantom
	 */
	private $view;

	/**
	 * Construct a new Screenshot with a phantomjs path and script path
	 */
	public function __construct($engine, $view)
	{
		$this->engine = $engine;
		$this->view = $view;
	}

	/**
	 * Create script file with given view/options and then execute that
	 * script with given engine.
	 */
	public function snapshot($url, $path, $size = "8.5in*11in", $zoom = "")
	{
		$options = $this->getOptions($url, $path, $size, $zoom);

		$script = $this->view->get(compact('options'));

		$response = $this->engine->execute($script);

		if ($response->status !== 200)
		{
			throw BadResponseStatusException("Got a response status of " . $response->status, $response);
		}

		return $path;
	}

	/**
	 * Gets the options for this class
	 */
	private function getOptions($url, $path, $size, $zoom)
	{
		$options = new \StdClass;

		$options->url = $url;
		$options->path = $path;
		$options->size = $size;
		$options->zoom = $zoom;
		return $options;
	}

}