<?php namespace Definitely246\Snapshot;

class Snapshot
{
	/**
	 * Pdf Snapshot
	 */
	private $pdfSnapshot;

	/**
	 * Construct
	 */
	public function __construct($pdfSnapshot)
	{
		$this->pdfSnapshot = $pdfSnapshot;
	}

	/**
	 * Create script file with given view/options and then execute that
	 * script with given engine.
	 */
	public function pdf($url, $path, $size = "8.5in*11in", $zoom = "")
	{
		return $this->pdfSnapshot->snapshot($url, $path, $size, $zoom);
	}
}