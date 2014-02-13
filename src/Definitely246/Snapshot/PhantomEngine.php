<?php namespace Definitely246\Snapshot;

class PhantomEngine
{
	/**
	 * Location of the phantomjs executable
	 */
	private $phantomPath;

	/**
	 * Place to store script files while running with phantom
	 */
	private $scriptsPath;

	/**
	 * Construct a new instance with a phantomjs path and script path
	 */
	public function __construct($phantomPath = null, $scriptsPath = null)
	{
		$this->phantomPath = $phantomPath ?: __DIR__ . '/../../../bin/phantomjs';
		$this->scriptsPath = $scriptsPath ?: sys_get_temp_dir();
	}

	/**
	 * Execute this script
	 */
	public function execute($script)
	{
		if (file_exists($script))
		{
			return $this->executeFile($script);
		}

		$script = $this->createTemporaryFileWithContents($script);
		$results = $this->executeFile($script);
		unlink($script);

		return $results;
	}

	/**
	 * Creates a file with the given contents
	 */
	protected function createTemporaryFileWithContents($content)
	{
		do
		{
			$filename = $this->scriptsPath . '/' . $this->randomString() . '.js';
		} while(file_exists($filename));

		file_put_contents($filename, $content);

		return $filename;
	}

	/**
	 * Execute this javascript with the phantomPath given
	 */
	protected function executeFile($filename)
	{
		$executable = realpath($this->phantomPath);

		$cmd  = escapeshellcmd(sprintf("%s %s", $executable, $filename));

		$output = shell_exec($cmd);

		return json_decode($output);
	}

	/**
	 * Gets a random string with given length from the $pool
	 */
	private function randomString($length = 16, $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
	{
		return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
	}


}