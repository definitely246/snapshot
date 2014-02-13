<?php namespace Definitely246\Snapshot;

/**
 * Borrowed from Laravel's PhpEngine class for Views.
 */
class PhpView {

	/**
	 * Used to keep a default path on this class
	 */
	private $path;

	/**
	 * Construct with a 
	 */
	public function __construct($path)
	{
		$this->path = $path;
	}

	/**
	 * Get the evaluated contents of the view.
	 *
	 * @param  array   $data
	 * @return string
	 */
	public function get(array $data = array())
	{
		return $this->evaluatePath($this->path, $data);
	}

	/**
	 * Get the evaluated contents of the view at the given path.
	 *
	 * @param  string  $__path
	 * @param  array   $__data
	 * @return string
	 */
	protected function evaluatePath($__path, $__data)
	{
		ob_start();

		extract($__data);

		// We'll evaluate the contents of the view inside a try/catch block so we can
		// flush out any stray output that might get out before an error occurs or
		// an exception is thrown. This prevents any partial views from leaking.
		try
		{
			include $__path;
		}
		catch (\Exception $e)
		{
			$this->handleViewException($e);
		}

		return ltrim(ob_get_clean());
	}

	/**
	 * Handle a view exception.
	 *
	 * @param  Exception  $e
	 * @return void
	 */
	protected function handleViewException($e)
	{
		ob_get_clean(); throw $e;
	}

}