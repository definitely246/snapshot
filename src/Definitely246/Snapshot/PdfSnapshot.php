<?php namespace Definitely246\Snapshot;

use Codesleeve\Executejs\Runtimes\PhantomJsRuntime;

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
	public function __construct($engine = null, $view = null)
	{
		$this->engine = $engine ?: new PhantomJsRuntime;
		$this->view = $view ?: new Views\RasterizeView;
	}

	/**
	 * Create script file with given view/options and then execute that
	 * script with given engine.
	 */
	public function snapshot($url, $path, $options = array())
	{
		$options = $this->getOptions($url, $path, $options);

		$script = $this->view->render(compact('options'));

		$response = json_decode($this->engine->execute($script, array('async' => $options->async)));

		if ($options->async)
		{
			return $path;
		}

		if (!isset($response->status))
		{
			throw new Exceptions\BadResponseStatusException("Unknown response status!", $response);
		}

		if ($response->status !== 200)
		{
		 	throw new Exceptions\BadResponseStatusException("Got a response status of " . $response->status, $response);
		}

		return $path;
	}

	/**
	 * Gets the options for this class
	 */
	private function getOptions($url, $path, $options)
	{
		$container = new \StdClass;

		$container->url = $url;
		$container->path = $path;

		$options['size'] = !array_key_exists('size', $options) ? "8.5in*11in" : $options['size'];
		$options['zoom'] = !array_key_exists('zoom', $options) ? "" : $options['zoom'];
		$options['cookie'] = !array_key_exists('cookie', $options) ? "null" : $options['cookie'];
		$options['headers'] = !array_key_exists('headers', $options) ? "{}" : $options['headers'];
		$options['async'] = !array_key_exists('async', $options) ? false : $options['async'];

		foreach ($options as $optionKey => $optionValue)
		{
			$container->$optionKey = $optionValue;
		}

		return $container;
	}

}