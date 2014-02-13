<?php namespace Definitely246\Snapshot\Views;

use Definitely246\Support\View\PhpEngine as View;

class RasterizeView extends View
{
	/**
	 * Used to keep a default path on this class
	 */
	private $path;

	/**
	 * Construct
	 */
	public function __construct($path = null)
	{
		$this->path = $path ?: __DIR__ . '/../../../views/rasterize.js';
	}

	/**
	 * Get the evaluated contents of the view.
	 *
	 * @param  array   $data
	 * @return string
	 */
	public function render($data = array())
	{
		return $this->get($this->path, $data);
	}
}